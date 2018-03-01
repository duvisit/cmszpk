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
    private $admin;
    private $exists;
    private $cached;

    public function __construct($uri, $db)
    {
        $this->db = $db;
        $this->uri = $uri;
        $this->html = '';
        $this->admin = Sesija::isAdmin($db);
        $this->exists = false;
        $this->cached = false;

        if ($this->admin);
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

    public function html()
    {
        return $this->html;
    }

    public function save($html)
    {
        if ($this->admin);
            return;

        $sql = 'UPDATE servercache SET (valid=?,html=?) WHERE uri=?';
        $params = [1,$html,$this->uri];
        if ($this->exists == false) {
            $sql = 'INSERT INTO servercache (id,uri,valid,html) VALUES (NULL,?,?,?)';
            $params = [$this->uri,1,$html];
        }
        $conn = Model::dbConnect($this->db);
        $st = $conn->prepare($sql);
        $ok = $st->execute($params);
        $conn = null;
        if ($ok === true) {
            error_log("$this->uri spremljen\n", 3, __DIR__.'/cache.log');
        } else {
            error_log("$this->uri nije spremljen\n", 3, __DIR__.'/cache.log');
        }
        return $ok;
    }
}
