<?php
namespace Sustav\Pogled;

use Sustav\Model\Model;
use Sustav\Model\Spremnik;
use Sustav\Upravljac\Sesija;
use Sustav\Upravljac\Upravljac;

/**
 * Odgovor modela na upit.
 *
 * URI: Uniform Resource Identifier
 */
class Sadrzaj
{
    private $upravljac;

    /**
     * Konstruktor.
     *
     * @param Upravljac $upravljac Upravljač.
     */
    public function __construct(Upravljac $upravljac)
    {
        $this->upravljac = $upravljac;
    }

    /**
     * Pogledaj sadržaj preko upravljača.
     *
     * @return array Status.
     */
    public function pogledaj() : array
    {
        return $this->upravljac->pokreni($this);
    }

    /**
     * Prikaži upute za urednike sadržaja.
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderHelp(string $uri, array $vars) : array
    {
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $menu = [];
            foreach ($vars['tables'] as $m) {
                $menu[] = ['slug' => "/admin/$m", 'title' => $m];
            }
            $alertmsg = null;
            if (isset($_SESSION['alertmsg'])) {
                $alertmsg = $_SESSION['alertmsg'];
                unset($_SESSION['alertmsg']);
            }
            $table = 'help';
            $username = $_SESSION['username'];
            include($vars['htmldir'] . "admin/header.php");
            include($vars['htmldir'] . "admin/help.php");
            include($vars['htmldir'] . "admin/footer.php");
            return ['code' => 200];
        }
        return ['code' => 405];
    }

    /**
     * Prikaži predložak.
     *
     * @param string $uri Staza zahtjeva.
     * @param string $lang Jezik predloška.
     * @param string $table Naziv tablice.
     * @param string $slug Naziv zapisa u bazi podataka.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderTemplate(string $uri, string $lang, string $table, string $slug, array $vars) : array
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return ['code' => 405];
        }
        $menulang = "";
        if (empty($lang)) {
            $lang = $vars['lang'];
        } elseif ($lang === $vars['lang']) {
            return ['code' => 404];
        } else {
            $menulang = "/$lang";
        }
        if (empty($table)) {
            $table = 'page';
        }
        if (empty($slug)) {
            $slug = '/';
        }

        $conn = Model::dbConnect($vars['database']);
        $site = Model::sqlFetch(
            $conn,
            'SELECT * FROM website WHERE lang = ?',
            [$lang]
        );
        $menu = Model::sqlFetchAll(
            $conn,
            'SELECT menuid, slug, title FROM page WHERE lang = ? ORDER BY menuid',
            [$lang]
        );
        $page = Model::sqlFetch(
            $conn,
            "SELECT * FROM $table WHERE slug = ? AND lang = ?",
            [$slug, $lang]
        );
        if (empty($page)) {
            $conn = null;
            return ['code' => 404];
        }
        $langnav = Model::getLangnav($conn, $vars['lang'], $lang, $table, $page['id'], $page['sourceid']);
        $featstaff = Model::sqlFetchSingle(
            $conn,
            'SELECT media FROM page WHERE template = ?',
            ['stafflist']
        );
        $list = null;
        $listhref = $menulang;
        $menucurr = null;

        switch ($table) {
            case 'page':
                $menucurr = $page['menuid'];
                switch ($page['template']) {
                    case 'bloglist':
                    case 'blogonly':
                        $list = Model::sqlFetchAll(
                            $conn,
                            "SELECT * FROM blog WHERE lang = ?",
                            [$lang]
                        );
                        $listhref .= "/blog";
                        break;
                    case 'articlelist':
                    case 'articleonly':
                        $list = Model::sqlFetchAll(
                            $conn,
                            "SELECT * FROM article WHERE lang = ?",
                            [$lang]
                        );
                        $listhref .= "/article";
                        break;
                    case 'stafflist':
                        $list = Model::sqlFetchAll(
                            $conn,
                            "SELECT * FROM staff WHERE lang = ?",
                            [$lang]
                        );
                        $listhref .= "/staff";
                        break;
                    case 'gallery':
                        $list = Model::sqlFetchAll(
                            $conn,
                            "SELECT * FROM media WHERE lang = ? AND display = ?",
                            [$lang, 'gallery']
                        );
                        $listhref .= "/media";
                        break;
                    case 'product':
                        $list = Model::sqlFetchAll(
                            $conn,
                            "SELECT * FROM media WHERE lang = ? AND display = ?",
                            [$lang, 'product']
                        );
                        $listhref .= "/media";
                        break;
                    default:
                        break;
                }
                break;
            case 'blog':
                $menucurr = Model::sqlFetchSingle(
                    $conn,
                    "SELECT menuid FROM page WHERE template = ?",
                    ['bloglist']
                );
                break;
            case 'article':
                $menucurr = Model::sqlFetchSingle(
                    $conn,
                    "SELECT menuid FROM page WHERE template = ?",
                    ['articlelist']
                );
                break;
            case 'media':
                $menucurr = Model::sqlFetchSingle(
                    $conn,
                    "SELECT menuid FROM page WHERE template = ?",
                    ['gallery']
                );
                break;
            case 'staff':
                $menucurr = Model::sqlFetchSingle(
                    $conn,
                    "SELECT menuid FROM page WHERE template = ?",
                    ['stafflist']
                );
                break;
            default:
                break;
        }
        $conn = null;

        if (empty($site) || empty($menu)) {
            return ['code' => 500];
        }
        if ($lang !== $vars['lang'] && $site['enabled'] === 'no') {
            return ['code' => 404];
        }
        if (!isset($page['template'])) {
            $page['template'] = $table;
        }
        if (!in_array($page['template'], $vars['templates'])) {
            return ['code' => 404];
        }
        if ($lang === 'hr') {
            setlocale(LC_TIME, 'croatian');
        }
        include($vars['htmldir'] . 'header.php');
        include($vars['htmldir'] . 'menu.php');
        include($vars['htmldir'] . $page['template'] . '.php');
        include($vars['htmldir'] . 'footer.php');
        return ['code' => 200, 'path' => $uri];
    }

    /**
     * Prikaži listu objava.
     *
     * @param string $uri Staza zahtjeva.
     * @param string $lang Jezik predloška.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderBlogList(string $uri, string $lang, array $vars) : array
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return ['code' => 405];
        }
        $menulang = "";
        $listhref = "/blog";
        if ($lang !== $vars['lang']) {
            $menulang = "/$lang";
            $listhref = "/$lang/blog";
        }
        $table = 'blog';
        $page = [
            'lang' => $lang,
            'summary' => 'Blog list.',
            'keywords' => 'blog, list',
            'title' => 'Blog'
        ];

        $conn = Model::dbConnect($vars['database']);
        $site = Model::sqlFetch(
            $conn,
            'SELECT * FROM website WHERE lang = ?',
            [$lang]
        );
        $menu = Model::sqlFetchAll(
            $conn,
            'SELECT menuid, slug, title FROM page WHERE lang = ? ORDER BY menuid',
            [$lang]
        );
        $langnav = Model::getLangnav($conn, $vars['lang'], $lang, 'blog', '-1', '-1');
        $list = Model::sqlFetchAll(
            $conn,
            "SELECT * FROM blog WHERE lang = ?",
            [$lang]
        );
        $conn = null;

        $menucurr = 0;
        if (empty($site) || empty($menu)) {
            return ['code' => 500];
        }
        if ($lang !== $vars['lang'] && $site['enabled'] === 'no') {
            return ['code' => 404];
        }
        if ($lang === 'hr') {
            setlocale(LC_TIME, 'croatian');
        }
        include($vars['htmldir'] . 'header.php');
        include($vars['htmldir'] . 'menu.php');
        include($vars['htmldir'] . 'blogonly.php');
        include($vars['htmldir'] . 'footer.php');
        return ['code' => 200, 'path' => $uri];
    }

    /**
     * Prikaži listu dokumenata.
     *
     * @param string $uri Staza zahtjeva.
     * @param string $lang Jezik predloška.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderArticleList(string $uri, string $lang, array $vars) : array
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return ['code' => 405];
        }
        $menulang = "";
        $listhref = "/article";
        if ($lang !== $vars['lang']) {
            $menulang = "/$lang";
            $listhref = "/$lang/article";
        }
        $table = 'article';
        $page = [
            'lang' => $lang,
            'description' => 'Article list.',
            'keywords' => 'article, list',
            'title' => 'Article'
        ];

        $conn = Model::dbConnect($vars['database']);
        $site = Model::sqlFetch(
            $conn,
            'SELECT * FROM website WHERE lang = ?',
            [$lang]
        );
        $menu = Model::sqlFetchAll(
            $conn,
            'SELECT menuid, slug, title FROM page WHERE lang = ? ORDER BY menuid',
            [$lang]
        );
        $langnav = Model::getLangnav($conn, $vars['lang'], $lang, 'article', '-1', '-1');
        $list = Model::sqlFetchAll(
            $conn,
            "SELECT * FROM article WHERE lang = ?",
            [$lang]
        );
        $conn = null;

        $menucurr = 0;
        if (empty($site) || empty($menu)) {
            return ['code' => 500];
        }
        if ($lang !== $vars['lang'] && $site['enabled'] === 'no') {
            return ['code' => 404];
        }
        if ($lang === 'hr') {
            setlocale(LC_TIME, 'croatian');
        }
        include($vars['htmldir'] . 'header.php');
        include($vars['htmldir'] . 'menu.php');
        include($vars['htmldir'] . 'articleonly.php');
        include($vars['htmldir'] . 'footer.php');
        return ['code' => 200, 'path' => $uri];
    }

    /**
     * Prikaži stranicu za prijavu u sustav.
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderLogin(string $uri, array $vars) : array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $csrf = Sesija::sessionToken();
            $alertmsg = null;
            include($vars['htmldir'] . 'admin/login.php');
            return ['code' => 200];
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (Sesija::isPassword($vars['database'])) {
                return ['code' => 302, 'path' => '/admin/website'];
            }
            $csrf = Sesija::sessionToken();
            $alertmsg = 'Login failed';
            include($vars['htmldir'] . 'admin/login.php');
            return ['code' => 200];
        }
        return ['code' => 405];
    }

    /**
     * Odjava sa sustava (preusmjeri na naslovnu stranicu).
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderLogout(string $uri, array $vars) : array
    {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        session_regenerate_id();
        return ['code' => 302, 'path' => '/'];
    }

    /**
     * Prikaži pregled sadržaja.
     *
     * @param string $uri Staza zahtjeva.
     * @param string $table Naziv tablice sadržaja.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderAdmin(string $uri, string $table, array $vars) : array
    {
        if (!in_array($table, $vars['tables'])) {
            return ['code' => 500];
        }
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $conn = Model::dbConnect($vars['database']);
            $list = Model::sqlFetchAll($conn, "SELECT * FROM $table");
            $langlist = Model::sqlFetchColumn(
                $conn,
                "SELECT DISTINCT lang FROM website"
            );
            $conn = null;

            $menu = [];
            foreach ($vars['tables'] as $m) {
                $menu[] =['slug' => "/admin/$m", 'title' => $m];
            }
            $typelist = ['gallery', 'product', 'media'];
            $username = $_SESSION['username'];
            $alertmsg = null;
            if (isset($_SESSION['alertmsg'])) {
                $alertmsg = $_SESSION['alertmsg'];
                unset($_SESSION['alertmsg']);
            }
            include($vars['htmldir'] . "admin/header.php");
            include($vars['htmldir'] . "admin/tab$table.php");
            include($vars['htmldir'] . "admin/footer.php");
            return ['code' => 200];
        }
        return ['code' => 405];
    }

    /**
     * Prikaži stranicu za uređivanje sadržaja.
     *
     * @param string $uri Staza zahtjeva.
     * @param string $table Naziv tablice sadržaja.
     * @param string $id ID sadržaja.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderEdit(string $uri, string $table, string $id, array $vars) : array
    {
        if (!in_array($table, $vars['tables'])) {
            return ['code' => 500];
        }
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $conn = Model::dbConnect($vars['database']);
            $page = Model::sqlFetch(
                $conn,
                "SELECT * FROM $table WHERE id = ?",
                [$id]
            );
            $langlist = ( $table === 'users' ) ? null :
                Model::sqlFetchColumn($conn, "SELECT DISTINCT lang FROM website");
            $medialist = ( $table === 'users' || $table === 'website' ) ? null :
                Model::sqlFetchColumn($conn, 'SELECT DISTINCT media FROM media');
            $sourcelist = ( $table === 'users' || $table === 'website' ) ? null :
                Model::sqlFetchAll($conn, "SELECT id, title FROM $table");
            $conn = null;

            if (empty($page)) {
                return ['code' => 404];
            }
            $menu = [];
            foreach ($vars['tables'] as $m) {
                $menu[] =['slug' => "/admin/$m", 'title' => $m];
            }
            $csrf = Sesija::sessionToken();
            $username = $_SESSION['username'];
            include($vars['htmldir'] . "admin/header.php");
            include($vars['htmldir'] . "admin/edit$table.php");
            include($vars['htmldir'] . "admin/footer.php");
            return ['code' => 200];
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return ['code' => 405];
        }
        $idval = intval($id);
        $_SESSION['alertmsg'] = "Error editing record from table '$table'";

        if (isset($_POST['csrf']) && isset($_SESSION['csrf'])
            && hash_equals($_POST['csrf'], $_SESSION['csrf']) && $idval > 0 ) {
            if (isset($_POST['save'])) {
                $_SESSION['alertmsg'] = "Error saving record to table '$table'";
                $done = Model::saveRecord($vars['database'], $table, $idval);
                if ($done) {
                    $_SESSION['alertmsg'] = "Record saved to table '$table'";
                }
            } elseif (isset($_POST['delete'])) {
                $_SESSION['alertmsg'] = "Error deleting record from table '$table'";
                $done = Model::deleteRecord($vars['database'], $table, $idval);
                if ($done) {
                    $_SESSION['alertmsg'] = "Record deleted from table '$table'";
                }
            }
        }
        unset($_SESSION['csrf']);
        return ['code' => 302, 'path' => "/admin/$table"];
    }

    /**
     * Prikaži stranicu za stvaranje sadržaja.
     *
     * @param string $uri Staza zahtjeva.
     * @param string $table Naziv tablice sadržaja.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderCreate(string $uri, string $table, array $vars) : array
    {
        if (!in_array($table, $vars['tables'])) {
            return ['code' => 500];
        }
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $langlist = null;
            $medialist = null;
            if ($table !== 'website' && $table !== 'users') {
                $conn = Model::dbConnect($vars['database']);
                $langlist = Model::sqlFetchColumn(
                    $conn,
                    "SELECT DISTINCT lang FROM website"
                );
                $medialist = Model::sqlFetchColumn(
                    $conn,
                    'SELECT DISTINCT media FROM media'
                );
                if ($table !== 'staff' && $table !== 'media') {
                    $sourcelist = Model::sqlFetchAll(
                        $conn,
                        "SELECT id, sourceid, title FROM $table"
                    );
                } else {
                    $sourcelist = Model::sqlFetchAll(
                        $conn,
                        "SELECT id, title FROM $table"
                    );
                }
                $conn = null;
            }
            $menu = [];
            foreach ($vars['tables'] as $m) {
                $menu[] =['slug' => "/admin/$m", 'title' => $m];
            }
            $csrf = Sesija::sessionToken();
            $username = $_SESSION['username'];
            include($vars['htmldir'] . "admin/header.php");
            include($vars['htmldir'] . "admin/new$table.php");
            include($vars['htmldir'] . "admin/footer.php");
            return ['code' => 200];
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return ['code' => 405];
        }
        $_SESSION['alertmsg'] = "Error creating new record for table '$table'";

        if (isset($_POST['csrf']) && isset($_SESSION['csrf'])
            && hash_equals($_POST['csrf'], $_SESSION['csrf'])
            && isset($_POST['save'])) {
            $result = Model::saveRecord($vars['database'], $table, null);
            if ($result === true) {
                $_SESSION['alertmsg'] = "New record created for table '$table'";
            }
        }
        unset($_SESSION['csrf']);
        return ['code' => 302, 'path' => "/admin/$table"];
    }

    /**
     * Prikaži stranicu za učitavanje datoteka.
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderUpload(string $uri, array $vars) : array
    {
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $conn = Model::dbConnect($vars['database']);
            $langlist = Model::sqlFetchColumn(
                $conn,
                "SELECT DISTINCT lang FROM website"
            );
            $conn = null;

            $menu = [];
            foreach ($vars['tables'] as $m) {
                $menu[] =['slug' => "/admin/$m", 'title' => $m];
            }
            $table = 'upload';
            $csrf = Sesija::sessionToken();
            $username = $_SESSION['username'];
            include($vars['htmldir'] . "admin/header.php");
            include($vars['htmldir'] . "admin/upload.php");
            include($vars['htmldir'] . "admin/footer.php");
            return ['code' => 200];
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return ['code' => 405];
        }
        $_SESSION['alertmsg'] = "Error uploading new image for table 'media'! ";

        if (isset($_POST['csrf']) && isset($_SESSION['csrf'])
            && hash_equals($_POST['csrf'], $_SESSION['csrf'])
            && isset($_POST['upload'])
            && isset($_FILES['userfile']['name'])
            && isset($_FILES['userfile']['tmp_name'])) {
            $_SESSION['alertmsg'] .= "Is uploaded file?";

            if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                $name = mb_strtolower(
                    basename($_FILES['userfile']['name']),
                    'UTF-8'
                );
                $filename = preg_replace('/[[:space:]]+/u', '-', $name);
                $uploadfile = $vars['uploaddir'] . "/upload/$filename";

                if (file_exists($uploadfile)) {
                    $_SESSION['alertmsg'] = "File exists, rename image file before upload";
                } else {
                    $_SESSION['alertmsg'] .= "MIME content type?";
                    $mimetype = mime_content_type($_FILES['userfile']['tmp_name']);
                    if (in_array($mimetype, ['image/jpeg', 'image/png'])) {
                        $srcfile = $_FILES['userfile']['tmp_name'];
                        $dstfile = $uploadfile;
                        $_SESSION['alertmsg'] .= "Move uploaded file? Source: '$srcfile'. Destination: '$dstfile'";
                        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                            $result = Model::saveUpload($vars['database'], $filename);
                            if ($result === true) {
                                $_SESSION['alertmsg'] = "Image '$filename' uploaded for table 'media'";
                            } else {
                                $_SESSION['alertmsg'] = "Save to database?";
                            }
                        }
                    } else {
                        $_SESSION['alertmsg'] = "Unsupported image type, convert to jpg or png before upload";
                    }
                }
            }
        }
        unset($_SESSION['csrf']);
        return ['code' => 302, 'path' => "/admin/media"];
    }

    /**
     * Izbriši nekorištene datoteke.
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderCleanup(string $uri, array $vars) : array
    {
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => "/admin/login"];
        }
        $conn = Model::dbConnect($vars['database']);
        $medialist = Model::sqlFetchColumn($conn, 'SELECT DISTINCT media FROM media');
        $conn = null;

        $uploadlist = glob($vars['uploaddir'] . '/upload/*');
        $_SESSION['alertmsg'] = "No unused images";
        $count = 0;
        $delfile = [];
        foreach ($uploadlist as $file) {
            if (is_file($file)) {
                $name = '/upload/' . basename($file);
                if (!in_array($name, $medialist)) {
                    unlink($file);
                    $count++;
                    $delfile[] = $name;
                }
            }
        }
        if ($count > 0) {
            $_SESSION['alertmsg'] = "Deleted $count unused image(s): " . $delfile[0];
            array_shift($delfile);
            foreach ($delfile as $file) {
                $_SESSION['alertmsg'] .= ", $file";
            }
        }
        return ['code' => 302, 'path' => "/admin/media"];
    }

    /**
     * Prikaži podatke o radu sustava.
     *
     * Podaci koji se prate: korištenje spremnika (cache.log) i greške sustava
     * (error.log).
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderLog(string $uri, array $vars) : array
    {
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $menu = [];
            foreach ($vars['tables'] as $m) {
                $menu[] =['slug' => "/admin/$m", 'title' => $m];
            }
            $alertmsg = null;
            if (isset($_SESSION['alertmsg'])) {
                $alertmsg = $_SESSION['alertmsg'];
                unset($_SESSION['alertmsg']);
            }
            $table = 'log';
            $username = $_SESSION['username'];
            include($vars['htmldir'] . "admin/header.php");
            include($vars['htmldir'] . "admin/viewlog.php");
            include($vars['htmldir'] . "admin/footer.php");
            return ['code' => 200];
        }
        return ['code' => 405];
    }

    /**
     * Izbriši podatke o radu sustava.
     *
     * @see Sadrzaj::renderLog()
     *
     * @param string $uri Staza zahtjeva.
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderLogClean(string $uri, array $vars) : array
    {
        $log = [__DIR__.'/cache.log', __DIR__.'/error.log'];
        foreach ($log as $filename) {
            $handle = fopen($filename, 'w');
            fwrite($handle, PHP_EOL);
            fclose($handle);
        }
        return $this->renderLog($uri, $vars);
    }

    /**
     * Prikaži sučelje za rad sa SQLite bazom podataka.
     *
     * Metoda koristi [Adminer](https://www.adminer.org/).
     *
     * @param array $vars Postavke sustava.
     * @return array Status.
     */
    public function renderSqlite(array $vars) : array
    {
        if (!Sesija::isAdmin($vars['database'])) {
            return ['code' => 302, 'path' => '/admin/login'];
        }
        include __DIR__.'/adminer/sqlite.php';
        return ['code' => 200];
    }
}
