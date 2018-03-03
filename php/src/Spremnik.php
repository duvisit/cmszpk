<?php
namespace Sustav\Model;

use PDO;
use Sustav\Model\Model;
use Sustav\Upravljac\Sesija;

/**
 * Spremnik sadržaja.
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

    public function __construct($uri, $db)
    {
        $this->db = $db;
        $this->uri = $uri;
        $this->html = '';
        $this->stamp = time();
        $this->admin = Sesija::isAdmin($db);
        $this->exists = false;
        $this->cached = false;

        if ($this->admin)
            return;

        $conn = Model::dbConnect($db);
        $data = Model::sqlFetch(
            $conn,
            'SELECT valid,html FROM servercache WHERE uri=?',
            [$uri]
        );
        $conn = null;
        if ($data !== false) {
            $this->exists = true;
            $valid = intval($data['valid']);
            if ($valid > 0) {
                $this->html = $data['html'];
                $this->cached = true;
            }
        }
    }

    public function ready()
    {
        return $this->cached;
    }

    public function feedReady()
    {
        if ($this->cached) {
            $this->cached = false;
            $conn = Model::dbConnect($this->db);
            $result = sqlFetchSingle(
                $conn,
                'SELECT stamp FROM fbfeed WHERE id=1'
            );
            $conn = null;
            if ($result !== false) {
                $diff = $this->stamp - $result;
                if ($diff < (4 * 60 * 60)) {
                    $this->cached = true;
                }
            }
        }
        return $this->cached;
    }

    public function html()
    {
        return $this->html;
    }

    public function save($html)
    {
        if ($this->admin)
            return;

        $sql = 'UPDATE servercache SET (valid=:valid,html=:html) WHERE uri=:uri';
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
