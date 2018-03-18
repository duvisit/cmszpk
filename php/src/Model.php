<?php
namespace Sustav\Model;

use PDO;
use Ausi\SlugGenerator\SlugGenerator;
use Sustav\Funkcije;

/**
 * Model sadržaja.
 */
class Model
{
    /**
     * Povezivanje s bazom podataka.
     *
     * ```
     * Open connection:
     * $conn = dbConnect( $db );
     *
     * Prepare and execute:
     * $sql = 'SELECT * FROM table WHERE attr = ?';
     * $st = $conn->prepare( $sql );
     * $st->execute( array( $attr ));
     *
     * Fetch single row:
     * $result = $st->fetch();
     * Result: array( 'attr' => 'value', ... )
     *
     * Fetch all rows:
     * $result = $st->fetchAll();
     * Result: array( array( 'attr' => 'value', ... ), ... )
     *
     * Fetch single attribute:
     * $sql = 'SELECT attr FROM table';
     * $st = $conn->prepare( $sql );
     * $st->execute();
     * $result = $st->fetchAll( PDO::FETCH_COLUMN );
     * Result: array( 'value', ... )
     *
     * Close connection:
     * $conn = null;
     * ```
     *
     * @param array $db Postavke baze podataka.
     * @return PDO PHP Database Object
     */
    public static function dbConnect(array $db) : PDO
    {
        return new PDO($db['dsn'], $db['user'], $db['pass'], $db['options']);
    }

    /**
     * Dohvati jedan redak iz baze podataka prema upitu.
     *
     * @param PDO $conn Veza s bazom podataka.
     * @param string $sql SQL upit.
     * @param array $params Polje parametara SQL upita.
     * @return array Polje odgovora na upit ili prazno polje.
     */
    public static function sqlFetch(PDO $conn, string $sql, array $params = null) : array
    {
        $st = $conn->prepare($sql);
        if (isset($params)) {
            $st->execute($params);
        } else {
            $st->execute();
        }
        $result = $st->fetch();
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * Dohvati sve retke iz baze podataka prema upitu.
     *
     * @param PDO $conn Veza s bazom podataka.
     * @param string $sql SQL upit.
     * @param array $params Polje parametara SQL upita.
     * @return array Polje polja odgovora na upit ili prazno polje.
     */
    public static function sqlFetchAll(PDO $conn, string $sql, array $params = null) : array
    {
        $st = $conn->prepare($sql);
        if (isset($params)) {
            $st->execute($params);
        } else {
            $st->execute();
        }
        $result = $st->fetchAll();
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * Dohvati jedan stupac iz baze podataka prema upitu.
     *
     * @param PDO $conn Veza s bazom podataka.
     * @param string $sql SQL upit.
     * @param array $params Polje parametara SQL upita.
     * @return array Polje odgovora na upit ili prazno polje.
     */
    public static function sqlFetchColumn(PDO $conn, string $sql, array $params = null) : array
    {
        $st = $conn->prepare($sql);
        if (isset($params)) {
            $st->execute($params);
        } else {
            $st->execute();
        }
        $result = $st->fetchAll(PDO::FETCH_COLUMN);
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * Dohvati samo jedan podatak iz baze podataka prema upitu.
     *
     * @param PDO $conn Veza s bazom podataka.
     * @param string $sql SQL upit.
     * @param array $params Polje parametara SQL upita.
     * @return string Odgovor na upit ili prazan string.
     */
    public static function sqlFetchSingle(PDO $conn, string $sql, array $params = null) : string
    {
        $st = $conn->prepare($sql);
        if (isset($params)) {
            $st->execute($params);
        } else {
            $st->execute();
        }
        $result = $st->fetchAll(PDO::FETCH_COLUMN);
        if ($result !== false && isset($result[0])) {
            return $result[0];
        }
        return '';
    }

    /**
     * Dohvati dostupne jezike.
     *
     * @param PDO $conn Veza s bazom podataka.
     * @param string $default Glavni jezik sustava.
     * @param string $lang Trenutni jezik stranice.
     * @param string $table Tablica sadržaja stranice.
     * @param string $recordid ID sadržaja.
     * @param string $sourceid ID izvornog sadržaja.
     * @return array Polje dostupnih jezika ili prazno polje.
     */
    public static function getLangnav(
        PDO $conn,
        string $default,
        string $lang,
        string $table,
        string $recordid,
        string $sourceid
    ) {
        $result = self::sqlFetchAll(
            $conn,
            'SELECT lang FROM website WHERE NOT lang = ? AND enabled = ?',
            [$lang, 'yes']
        );
        if (empty($result)) {
            return [];
        }

        $recid = intval($recordid);
        $srcid = intval($sourceid);
        $tabslug = "";

        if (in_array($table, ['blog', 'article'])) {
            $tabslug = "/$table";
        }

        if ($srcid == 0) {
            foreach ($result as &$item) {
                $slug = self::sqlFetch(
                    $conn,
                    "SELECT slug FROM $table WHERE lang = ? AND sourceid = $recid",
                    [$item['lang']]
                );
                if (empty($slug)) {
                    if ($item['lang'] === $default) {
                        $item['slug'] = $tabslug;
                    } else {
                        $item['slug'] = '/' . $item['lang'] . $tabslug;
                    }
                } else {
                    if ($item['lang'] === $default) {
                        $item['slug'] = $tabslug . $slug['slug'];
                    } else {
                        $item['slug'] = '/' . $item['lang'] . $tabslug . $slug['slug'];
                    }
                }
            }
        } elseif ($srcid > 0) {
            foreach ($result as &$item) {
                $slug = self::sqlFetch(
                    $conn,
                    "SELECT slug FROM $table WHERE lang = ? AND sourceid = $srcid",
                    [$item['lang']]
                );
                if (empty($slug)) {
                    $slug = self::sqlFetch(
                        $conn,
                        "SELECT slug FROM $table WHERE lang = ? AND id = $srcid",
                        [$item['lang']]
                    );
                    if (empty($slug)) {
                        if ($item['lang'] === $default) {
                            $item['slug'] = $tabslug;
                        } else {
                            $item['slug'] = '/' . $item['lang'] . $tabslug;
                        }
                    } else {
                        if ($item['lang'] === $default) {
                            $item['slug'] = $tabslug . $slug['slug'];
                        } else {
                            $item['slug'] = '/' . $item['lang'] . $tabslug . $slug['slug'];
                        }
                    }
                } else {
                    if ($item['lang'] === $default) {
                        $item['slug'] = $tabslug . $slug['slug'];
                    } else {
                        $item['slug'] = '/' . $item['lang'] . $tabslug . $slug['slug'];
                    }
                }
            }
        } else {
            foreach ($result as &$item) {
                if ($item['lang'] === $default) {
                    $item['slug'] = $tabslug;
                } else {
                    $item['slug'] = '/' . $item['lang'] . $tabslug;
                }
            }
        }
        return $result;
    }

    /**
     * Dohvati naziv izvornog sadržaja.
     *
     * @param array $db Postavke baze podataka.
     * @param string $table Tablica sadržaja.
     * @param string $id ID izvornog sadržaja.
     * @return string Naziv sadržaja ili prazan string.
     */
    public static function getSourceTitle(array $db, string $table, string $id) : string
    {
        $sourceid = intval($id);
        if ($sourceid == 0) {
            return '';
        }
        $conn = self::dbConnect($db);
        $title = self::sqlFetchSingle($conn, "SELECT title FROM $table WHERE id=$sourceid");
        $conn = null;
        if ($title) {
            return $title;
        }
        return '';
    }

    /**
     * Izbriši zapis u bazi podataka.
     *
     * @param array $db Postavke baze podataka.
     * @param string $table Tablica zapisa.
     * @param string $id ID zapisa.
     * @return bool Ako je zapis izbrisan TRUE, inače FALSE.
     */
    public static function deleteRecord(array $db, string $table, string $id) : bool
    {
        $conn = self::dbConnect($db);
        $result = $conn->exec("DELETE FROM $table WHERE id=$id");
        $conn = null;
        return $result;
    }

    /**
     * Spremi zapis o učitanim datotekama u bazu podataka.
     *
     * @param array $db Postavke baze podataka.
     * @param string $filename Naziv datoteke.
     * @return bool Ako je zapis spremljen TRUE, inače FALSE.
     */
    public static function saveUpload(array $db, string $filename) : bool
    {
        $sqlcol = [];
        $params = [];

        $sqlcol[] = 'datum';
        $params[':datum'] = date('Y-m-d', time());

        $sqlcol[] = 'media';
        $params[':media'] = "/upload/$filename";

        foreach (['lang','display','title','summary'] as $key) {
            $sqlcol[] = $key;
            $params[":$key"] = Funkcije::filterInput($_POST[$key]);
        }
        $list = [];
        $values = [];
        foreach ($sqlcol as $key) {
            $list[] = $key;
            $values[] = ":$key";
        }
        $colset = implode(',', $list);
        $colval = implode(',', $values);
        $sql = "INSERT INTO media (id,$colset) VALUES (NULL,$colval)";

        $conn = self::dbConnect($db);
        $st = $conn->prepare($sql);
        $result = $st->execute($params);
        $conn = null;

        return $result;
    }

    /**
     * Spremi zapis u bazu podataka.
     *
     * @param array $db Postavke baze podataka.
     * @param string $table Tablica zapisa.
     * @param string $id ID zapisa za ažuriranje.
     * @return bool Ako je zapis spremljen TRUE, inače FALSE.
     */
    public static function saveRecord(array $db, string $table, string $id = null) : bool
    {
        //     address     VARCHAR(255) NOT NULL
        //     city        VARCHAR(255) NOT NULL
        //     comment     VARCHAR(255) NOT NULL
        //     content     TEXT NOT NULL
        //     country     VARCHAR(255) NOT NULL
        //     datum       TEXT NOT NULL
        //     description VARCHAR(255) NOT NULL
        //     display     VARCHAR(255) NOT NULL
        //     email       VARCHAR(255) NOT NULL
        //     enabled     CHAR(4) NOT NULL
        //     keywords    TEXT NOT NULL
        //     lang        CHAR(2) NOT NULL
        //     logo        VARCHAR(255) NOT NULL
        //     media       VARCHAR(255) NOT NULL
        //     menuid      INTEGER NOT NULL
        //     name        VARCHAR(255) NOT NULL
        //     password    VARCHAR(255) NOT NULL
        //     phone       VARCHAR(255) NOT NULL
        //     slug        VARCHAR(255) NOT NULL
        //     sourceid    INTEGER NOT NULL
        //     summary     TEXT NOT NULL
        //     template    VARCHAR(255) NOT NULL
        //     title       VARCHAR(255) NOT NULL
        //     username    VARCHAR(255) NOT NULL
        //     zipcode     VARCHAR(255) NOT NULL
        $records = [
            'address', 'city', 'comment', /*'content',*/ 'country',
            /*'datum',*/ 'description', 'display', 'email', 'enabled',
            'keywords', 'lang', 'logo', 'media', 'menuid', 'name',
            /*'password',*/ 'phone', /*'slug',*/ 'summary', 'sourceid',
            'template', 'title', 'username', 'zipcode'
        ];
        $sqlcol = [];
        $params = [];

        $sqlcol[] = 'datum';
        $params[':datum'] = date('Y-m-d', time());

        foreach ($records as $item) {
            if (isset($_POST[$item])) {
                $sqlcol[] = $item;
                $params[":$item"] = Funkcije::filterInput($_POST[$item]);
            }
        }
        if (!in_array($table, ['website','users','media'])) {
            $sqlcol[] = 'slug';
            $params[':slug'] = '/';
            if ($table === 'page') {
                if ($params[':template'] !== 'home') {
                    $generator = new SlugGenerator();
                    $params[':slug'] .= $generator->generate($params[':title']);
                }
            } else {
                $generator = new SlugGenerator();
                $params[':slug'] .= $generator->generate($params[':title']);
            }
        }
        if (isset($_POST['content'])) {
            $sqlcol[] = 'content';
            $params[':content'] = Funkcije::purifyHtml($_POST['content']);
        }
        if (isset($_POST['password'])) {
            $sqlcol[] = 'password';
            $params[':password'] = password_hash(
                $_POST['password'],
                PASSWORD_DEFAULT
            );
        }
        $sql = '';
        if (isset($id)) {
            $params[':id'] = $id;
            $list = [];
            foreach ($sqlcol as $key) {
                $list[] = "$key=:$key";
            }
            $colset = implode(',', $list);
            $sql = "UPDATE $table SET $colset WHERE id=:id";
        } else {
            $list = [];
            $values = [];
            foreach ($sqlcol as $key) {
                $list[] = $key;
                $values[] = ":$key";
            }
            $colset = implode(',', $list);
            $colval = implode(',', $values);
            $sql = "INSERT INTO $table (id,$colset) VALUES (NULL,$colval)";
        }
        $conn = self::dbConnect($db);
        $st = $conn->prepare($sql);
        $result = $st->execute($params);

        $sql = 'UPDATE servercache SET valid=0';
        $st = $conn->prepare($sql);
        $st->execute();

        $conn = null;
        return $result;
    }
}
