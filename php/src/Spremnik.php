<?php
namespace Sustav\Model;

use PDO;
use Sustav\Model\Model;
use Sustav\Upravljac\Sesija;

/**
 * Spremnik sadržaja.
 *
 * Spremnik se ne koristi za vrijeme sesije urednika sadržaja.
 *
 * ```
 * # Podaci o vremenu potrebnom za obradu zahtjeva
 * # tip:
 * #    cache  = spremnik se koristi
 * #    buffer = spremnik se koristi (korak spremanja podataka)
 * #    normal = spremnik se ne koristi
 * # uri - tip - vrijeme
 * /    cache   0.0010
 * /    cache   0.0013
 * /    normal  0.0186
 * /    normal  0.0204
 * /    buffer  0.3491
 * /article/dokument    cache   0.0009
 * /article/dokument    normal  0.0085
 * /article/dokument    buffer  0.1440
 * /blog    cache   0.0010
 * /blog    normal  0.0013
 * /blog    buffer  0.3442
 * /blog/objava cache   0.0009
 * /blog/objava normal  0.0089
 * /blog/objava buffer  0.1465
 * /dokumentacija   cache   0.0010
 * /dokumentacija   normal  0.0017
 * /dokumentacija   buffer  0.1177
 * /en  cache   0.0012
 * /en  normal  0.0180
 * /en  normal  0.0206
 * /en  buffer  0.1858
 * /en/article/document cache   0.0013
 * /en/article/document normal  0.0065
 * /en/article/document buffer  0.1485
 * /en/blog cache   0.0012
 * /en/blog normal  0.0014
 * /en/blog buffer  0.1976
 * /en/blog/post    cache   0.0010
 * /en/blog/post    normal  0.0067
 * /en/blog/post    buffer  0.1219
 * /en/documentation    cache   0.0009
 * /en/documentation    normal  0.0016
 * /en/documentation    buffer  0.1218
 * ```
 */
class Spremnik
{
    private $db;
    private $uri;
    private $html;
    private $stamp;
    private $admin;
    private $exists;
    private $cached;

    /**
     * Konstruktor.
     *
     * @param string $uri URI sadržaja.
     * @param array $db Postavke baze podataka.
     */
    public function __construct($uri, $db)
    {
        $this->db = $db;
        $this->uri = $uri;
        $this->html = '';
        $this->stamp = time();
        $this->admin = Sesija::isAdmin($db);
        $this->exists = false;
        $this->cached = false;

        if ($this->admin) {
            return;
        }
        $conn = Model::dbConnect($db);
        $data = Model::sqlFetch(
            $conn,
            'SELECT valid,html FROM servercache WHERE uri=?',
            [$uri]
        );
        $conn = null;
        if ($data !== false) {
            $this->exists = true;
            $cachestamp = intval($data['valid']);
            if ($cachestamp > 0
                && (($this->stamp - $cachestamp) < (4 * 60 * 60))) {
                $this->html = $data['html'];
                $this->cached = true;
            }
        }
    }

    /**
     * Sadržaj je spreman?
     *
     * @return bool Ako je sadržaj spreman TRUE, inače FALSE.
     */
    public function ready() : bool
    {
        return $this->cached;
    }

    /**
     * HTML sadržaja.
     *
     * @return string HTML sadržaja.
     */
    public function html() : string
    {
        return $this->html;
    }

    /**
     * Spremi html sadržaja u spremnik.
     *
     * @return bool Ako je sadržaj spremljen TRUE, inače FALSE.
     */
    public function save($html) : bool
    {
        if ($this->admin) {
            return true;
        }
        $sql = 'UPDATE servercache SET valid=:valid, html=:html WHERE uri=:uri';
        if ($this->exists == false) {
            $sql = 'INSERT INTO servercache (id,uri,valid,html) VALUES (NULL,:uri,:valid,:html)';
        }
        $params = [
            ':uri' => $this->uri,
            ':valid' => $this->stamp,
            ':html' => $html
        ];
        $conn = Model::dbConnect($this->db);
        $st = $conn->prepare($sql);
        $ok = $st->execute($params);
        $conn = null;
        return $ok;
    }
}
