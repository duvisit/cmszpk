<?php
namespace Sustav\Model;

use Sustav\Postavke;
use Sustav\Model\Model;
use Sustav\Funkcije;

/**
 * Facebook Graph API.
 */
class Facebook
{
    /**
     * Pretvori tekst poruke u niz html odlomaka.
     *
     * @param string $message Tekst poruke.
     * @return string Html poruke.
     */
    private static function fbMessage(string $message) : string
    {
        $msg = '';
        $array = preg_split("/\r\n|\n|\r/", $message);
        foreach ($array as $value) {
            if (!empty($value)) {
                $msg .= '<p>'.$value.'</p>';
            }
        }
        return $msg;
    }

    /**
     * Spremnik Facebook objava.
     *
     * Dohvati objave s Facebook poslužitelja ili spremljene podatake iz baze
     * podataka.
     *
     * @return array Polje objava ili prazno polje.
     */
    private static function fbCache() : array
    {
        $postavke = new Postavke();
        $database = $postavke->database();
        $page_id = $postavke->facebookPageId();
        $app_id = $postavke->facebookAppId();
        $app_secret = $postavke->facebookAppSecret();
        $api_version = $postavke->facebookApiVersion();

        $conn = Model::dbConnect($database);
        $data = Model::sqlFetchAll($conn, "SELECT * FROM fbfeed ORDER BY id ASC LIMIT 9");
        $conn = null;

        if (empty($page_id) || empty($app_id) || empty($app_secret)) {
            return $data;
        }
        if (!empty($data)) {
            $timestamp = intval($data[0]['stamp']);
            if (( time() - $timestamp ) < ( 4 * 60 * 60 )) {
                return $data;
            }
        }
        try {
            $response = file_get_contents(
                "https://graph.facebook.com/oauth/access_token?"
                ."client_id={$app_id}&client_secret={$app_secret}&grant_type=client_credentials"
            );
            if ($response === false) {
                return $data;
            }
            $json_token = json_decode($response, true);
            $access_token = empty($json_token['access_token']) ? false : $json_token['access_token'];
            if ($access_token === false) {
                return $data;
            }
            $fields = 'id,type,message,picture,link,name,caption,created_time,object_id';
            $json_data = file_get_contents(
                "https://graph.facebook.com/{$api_version}/{$page_id}/feed?"
                ."access_token={$access_token}&fields={$fields}&limit=9"
            );
            if ($json_data === false) {
                return $data;
            }
        } catch \Exception (e) {
            $logfile = __DIR__.'/error.log';
            error_log(date(DATE_ATOM), 3, $logfile);
            error_log("\t", 3, $logfile);
            error_log(e->getMessage(), 3, $logfile);
            error_log(PHP_EOL, 3, $logfile);
            return $data;
        }
        $fbfeed = json_decode($json_data, true);
        //echo '<pre>', print_r($fbfeed, true), '</pre>';

        $id = 1;
        $stamp = time();
        $records = array(
            'id','type','message','picture','link','name','caption','created_time','object_id'
        );
        $conn = Model::dbConnect($database);
        $conn->beginTransaction();

        foreach ($fbfeed['data'] as $fbpost) {
            $sqlcol = array();
            $params = array();

            $sqlcol[] = 'stamp';
            $params[':stamp'] = $stamp;

            foreach ($records as $item) {
                $sqlcol[] = "fb_$item";
                $itemdata = "";
                if (!empty($fbpost[$item])) {
                    $escaped = htmlspecialchars($fbpost[$item], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    switch ($item) {
                        case 'message':
                            $itemdata = self::fbMessage($escaped);
                            break;
                        default:
                            $itemdata = $escaped;
                            break;
                    }
                }
                $params[":fb_$item"] = $itemdata;
            }
            $list = array();
            foreach ($sqlcol as $key) {
                $list[] = "$key=:$key";
            }
            $colset = implode(',', $list);

            $sql = "UPDATE fbfeed SET $colset WHERE id=$id";

            $st = $conn->prepare($sql);
            $st->execute($params);

            $id += 1;
        }
        $conn->commit();

        $data = Model::sqlFetchAll($conn, "SELECT * FROM fbfeed ORDER BY id ASC LIMIT 9");
        $conn = null;
        if ($data) {
            return $data;
        }
        return [];
    }

    /**
     * Ispis greške.
     *
     * @param string $lang Jezik teksta greške.
     */
    private static function fbError($lang) : void
    {
        $date = iconv('ISO-8859-2', 'UTF-8', strftime('%e. %B, %Y.', time()));
?>
<div class="uk-width-medium-1-3">
<div class="uk-panel uk-panel-box uk-panel-box-secondary">
<h3 class="uk-panel-title">Status</h3>
<div class="uk-article-meta"><?= Funkcije::escapeOutput($date) ?></div>
<p><?= Funkcije::escapeTrans("Facebook feed not available", $lang) ?></p>
</div>
</div>
<?php
    }

    /**
     * Ispis objave.
     *
     * @param string $date Datum objave.
     * @param string $type Kategorija objave.
     * @param string $picture Slika uz objavu.
     * @param string $link Veza na objavu.
     * @param string $message Tekst objave.
     */
    private static function fbPost(
        string $date,
        string $type,
        string $picture,
        string $link,
        string $message
    ) : void {
?>
<div class="uk-width-medium-1-3"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
<?php if ($picture != '') { ?>
<div class="uk-panel-teaser uk-cover-background"
style="height:240px; background-image:url('<?= Funkcije::escapeOutput($picture) ?>');"></div>
<?php } ?>
<h3 class="uk-panel-title">
<a class="uk-link" href="<?= Funkcije::escapeOutput($link) ?>"><?= Funkcije::escapeOutput($type) ?></a>
</h3>
<div class="uk-article-meta"><?= Funkcije::escapeOutput($date) ?></div>
<?= Funkcije::escapeHtml($message) ?>
</div></div>
<?php
    }

    /**
     * Ispis Facebook objava u html formatu.
     *
     * @param int $limit Broj objava za prikaz (od 1 do 9).
     * @param string $lang Jezik stranice u kojem se objava prikazuje.
     */
    public static function feed(int $limit, string $lang) : void
    {
        $fbfeed = self::fbCache();

        if (empty($fbfeed)) {
            self::fbError($lang);
            return;
        }
        $counter = ( $limit < 1 || $limit > 9 ) ? 3 : $limit;

        foreach ($fbfeed as $fbpost) {
            if (in_array($fbpost['fb_type'], ['status', 'link', 'photo', 'video', 'event', 'demo'])) {
                if ($counter-- == 0) {
                    break;
                }
                // TODO set date
                $date = '';
                if (isset($fbpost['fb_created_time'])) {
                    $date = iconv(
                        'ISO-8859-2',
                        'UTF-8',
                        strftime('%e. %B, %Y.', strtotime($fbpost['fb_created_time']))
                    );
                }
                $type    = ucfirst($fbpost['fb_type']);
                $picture = empty($fbpost['fb_picture']) ? '' : $fbpost['fb_picture'];
                $link    = empty($fbpost['fb_link'])    ? '' : $fbpost['fb_link'];
                $message = empty($fbpost['fb_message']) ? '' : $fbpost['fb_message'];
                //$caption = empty($fbpost['fb_caption']) ? '' : $fbpost['fb_caption'];
                //$name    = empty($fbpost['fb_name'])    ? '' : $fbpost['fb_name'];

                if ($type == 'Photo') {
                    $picture = "https://graph.facebook.com/{$fbpost['fb_object_id']}/picture?type=normal";
                }
                self::fbPost($date, $type, $picture, $link, $message);
            }
        }
    }
}
