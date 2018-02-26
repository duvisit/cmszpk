<?php
namespace Sustav\Pogled;

use Sustav\Model\Model;
use Sustav\Upravljac\Sesija;
use Sustav\Upravljac\Upravljac;

/**
 * Odgovor modela na upit.
 */
class Sadrzaj
{
    private $upravljac;

    public function __construct(Upravljac $upravljac)
    {
        $this->upravljac = $upravljac;
    }

    public function pogledaj()
    {
        return $this->upravljac->pokreni($this);
    }

    //############################################################################
    // HTML output functions

    function renderHelp ( $uri, $vars ) {

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => '/admin/login' ];

        if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {

            $menu = array();
            foreach ( $vars['tables'] as $m )
                $menu[] = array( 'slug' => "/admin/$m", 'title' => $m );

            $alertmsg = null;
            if ( isset( $_SESSION['alertmsg'] )) {
                $alertmsg = $_SESSION['alertmsg'];
                unset( $_SESSION['alertmsg'] );
            }

            $table = 'help';
            $username = $_SESSION['username'];
            include( $vars['htmldir'] . "admin/header.php" );
            include( $vars['htmldir'] . "admin/help.php" );
            include( $vars['htmldir'] . "admin/footer.php" );

            return [ 'code' => 200 ];
        }
        return [ 'code' => 405 ];
    }

    function renderTemplate ( $uri, $lang, $table, $slug, $vars ) {

        if ( $_SERVER['REQUEST_METHOD'] !== 'GET' )
            return [ 'code' => 405 ];

        $menulang = "";
        if ( !isset( $lang ))
            $lang = $vars['lang'];
        else if ( $lang === $vars['lang'] )
            return [ 'code' => 404 ];
        else
            $menulang = "/$lang";

        if ( !isset( $table ))
            $table = 'page';

        if ( !isset( $slug ))
            $slug = '/';

        $conn = Model::dbConnect( $vars['database'] );
        $site = Model::sqlFetch( $conn, 
            'SELECT * FROM website WHERE lang = ?', array( $lang ));
        $menu = Model::sqlFetchAll( $conn,
            'SELECT menuid, slug, title FROM page WHERE lang = ? ORDER BY menuid',
            array( $lang ));

        $page = Model::sqlFetch( $conn,
            "SELECT * FROM $table WHERE slug = ? AND lang = ?",
            array( $slug, $lang ));

        if ( $page === false ) {
            $conn = null;
            return [ 'code' => 404 ];
        }
        $langnav = Model::getLangnav( $conn, $vars['lang'], $lang, $table, $page['id'], $page['sourceid'] );

        $featstaff = Model::sqlFetchSingle( $conn,
            'SELECT media FROM page WHERE template = ?', array( 'stafflist' ));

        $list = null;
        $listhref = $menulang;
        $menucurr = null;

        if ( $table === 'page' ) {
            $menucurr = $page['menuid'];
            if ( $page['template'] === 'bloglist' || $page['template'] === 'blogonly' ) {
                $list = Model::sqlFetchAll( $conn,
                    "SELECT * FROM blog WHERE lang = ?", array( $lang ));
                $listhref .= "/blog";
            } else if ( $page['template'] === 'articlelist' || $page['template'] === 'articleonly' ) {
                $list = Model::sqlFetchAll( $conn,
                    "SELECT * FROM article WHERE lang = ?", array( $lang ));
                $listhref .= "/article";
            } else if ( $page['template'] === 'stafflist' ) {
                $list = Model::sqlFetchAll( $conn,
                    "SELECT * FROM staff WHERE lang = ?", array( $lang ));
                $listhref .= "/staff";
            } else if ( $page['template'] === 'gallery' ) {
                $list = Model::sqlFetchAll( $conn,
                    "SELECT * FROM media WHERE lang = ? AND display = ?",
                    array( $lang, 'gallery' ));
                $listhref .= "/media";
            } else if ( $page['template'] === 'product' ) {
                $list = Model::sqlFetchAll( $conn,
                    "SELECT * FROM media WHERE lang = ? AND display = ?",
                    array( $lang, 'product' ));
                $listhref .= "/media";
            }
        } else if ( $table === 'blog' ) {
            $menucurr = Model::sqlFetchSingle( $conn,
                "SELECT menuid FROM page WHERE template = ?",
                array( 'bloglist' ));
        } else if ( $table === 'article' ) {
            $menucurr = Model::sqlFetchSingle( $conn,
                "SELECT menuid FROM page WHERE template = ?",
                array( 'articlelist' ));
        } else if ( $table === 'media' ) {
            $menucurr = Model::sqlFetchSingle( $conn,
                "SELECT menuid FROM page WHERE template = ?",
                array( 'gallery' ));
        } else if ( $table === 'staff' ) {
            $menucurr = Model::sqlFetchSingle( $conn,
                "SELECT menuid FROM page WHERE template = ?",
                array( 'stafflist' ));
        }

        $conn = null;

        //return dumpme( array( 'uri'=>$uri, 'lang'=>$lang, 'table'=>$table,
        //    'slug'=>$slug, 'menu'=>$menu, 'menulang'=>$menulang, 'list'=>$list,
        //    'listhref'=>$listhref, 'page'=>$page ));

        if ( $site === false || $menu === false )
            return [ 'code' => 500 ];
        if ( $lang !== $vars['lang'] && $site['enabled'] === 'no' )
            return [ 'code' => 404 ];
        if ( !isset( $page['template'] ))
            $page['template'] = $table;
        if ( !in_array( $page['template'], $vars['templates'] ))
            return [ 'code' => 404 ];

        if ( $lang === 'hr' )
            setlocale( LC_TIME, 'croatian' );

        include( $vars['htmldir'] . 'header.php' );
        include( $vars['htmldir'] . 'menu.php' );
        include( $vars['htmldir'] . $page['template'] . '.php' );
        include( $vars['htmldir'] . 'footer.php' );

        return [ 'code' => 200 ];
    }

    function renderBlogList ( $uri, $lang, $vars ) {

        if ( $_SERVER['REQUEST_METHOD'] !== 'GET' )
            return [ 'code' => 405 ];

        $menulang = "";
        if ( $lang !== $vars['lang'] )
            $menulang = "/$lang";

        $table = 'blog';

        $conn = Model::dbConnect( $vars['database'] );
        $site = Model::sqlFetch( $conn, 
            'SELECT * FROM website WHERE lang = ?', array( $lang ));
        $menu = Model::sqlFetchAll( $conn,
            'SELECT menuid, slug, title FROM page WHERE lang = ? ORDER BY menuid',
            array( $lang ));

        $langnav = Model::getLangnav( $conn, $vars['lang'], $lang, 'blog', -1, -1 );

        $list = Model::sqlFetchAll( $conn,
            "SELECT * FROM blog WHERE lang = ?", array( $lang ));
        $listhref = "/blog";
        $menucurr = 0;

        $conn = null;

        //return dumpme( array( 'uri'=>$uri, 'lang'=>$lang, 'table'=>$table,
        //    'slug'=>$slug, 'menu'=>$menu, 'menulang'=>$menulang, 'list'=>$list,
        //    'listhref'=>$listhref, 'page'=>$page ));

        if ( $site === false || $menu === false )
            return [ 'code' => 500 ];
        if ( $lang !== $vars['lang'] && $site['enabled'] === 'no' )
            return [ 'code' => 404 ];

        if ( $lang === 'hr' )
            setlocale( LC_TIME, 'croatian' );

        include( $vars['htmldir'] . 'header.php' );
        include( $vars['htmldir'] . 'menu.php' );
        include( $vars['htmldir'] . 'blogonly.php' );
        include( $vars['htmldir'] . 'footer.php' );

        return [ 'code' => 200 ];
    }

    function renderArticleList ( $uri, $lang, $vars ) {

        if ( $_SERVER['REQUEST_METHOD'] !== 'GET' )
            return [ 'code' => 405 ];

        $menulang = "";
        if ( $lang !== $vars['lang'] )
            $menulang = "/$lang";

        $table = 'article';

        $conn = Model::dbConnect( $vars['database'] );
        $site = Model::sqlFetch( $conn, 
            'SELECT * FROM website WHERE lang = ?', array( $lang ));
        $menu = Model::sqlFetchAll( $conn,
            'SELECT menuid, slug, title FROM page WHERE lang = ? ORDER BY menuid',
            array( $lang ));

        $langnav = Model::getLangnav( $conn, $vars['lang'], $lang, 'article', -1, -1 );

        $list = Model::sqlFetchAll( $conn,
            "SELECT * FROM article WHERE lang = ?", array( $lang ));
        $listhref = "/article";
        $menucurr = 0;

        $conn = null;

        //return dumpme( array( 'uri'=>$uri, 'lang'=>$lang, 'table'=>$table,
        //    'slug'=>$slug, 'menu'=>$menu, 'menulang'=>$menulang, 'list'=>$list,
        //    'listhref'=>$listhref, 'page'=>$page ));

        if ( $site === false || $menu === false )
            return [ 'code' => 500 ];
        if ( $lang !== $vars['lang'] && $site['enabled'] === 'no' )
            return [ 'code' => 404 ];

        if ( $lang === 'hr' )
            setlocale( LC_TIME, 'croatian' );

        include( $vars['htmldir'] . 'header.php' );
        include( $vars['htmldir'] . 'menu.php' );
        include( $vars['htmldir'] . 'articleonly.php' );
        include( $vars['htmldir'] . 'footer.php' );

        return [ 'code' => 200 ];
    }

    function renderLogin ( $uri, $vars ) {
        if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
            $csrf = Sesija::sessionToken();
            $alertmsg = null;
            include( $vars['htmldir'] . 'admin/login.php' );
            return [ 'code' => 200 ];
        } else if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            if ( Sesija::isPassword( $vars['database'] ))
                return [ 'code' => 302, 'path' => '/admin/website' ];
            $csrf = Sesija::sessionToken();
            $alertmsg = 'Login failed';
            include( $vars['htmldir'] . 'admin/login.php' );
            return [ 'code' => 200 ];
        }
        return [ 'code' => 405 ];
    }

    function renderLogout ( $uri, $vars ) {
        if ( Sesija::isAdmin( $vars['database'] )) {
            // TODO redundant code
            unset( $_SESSION['username'] );
            unset( $_SESSION['csrf'] );
            session_unset();
            session_destroy();
            session_start();
            return [ 'code' => 302, 'path' => '/' ];
        }
        return [ 'code' => 302, 'path' => '/' ];
    }

    function renderAdmin ( $uri, $table, $vars ) {

        if ( !in_array( $table, $vars['tables'] ))
            return [ 'code' => 500 ];

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => '/admin/login' ];

        if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
            $conn = Model::dbConnect( $vars['database'] );
            $list = Model::sqlFetchAll( $conn, "SELECT * FROM $table" );
            $langlist = Model::sqlFetchColumn(
                $conn, "SELECT DISTINCT lang FROM website" );
            $conn = null;

            if ( $list === false )
                return [ 'code' => 500 ];

            $menu = array();
            foreach ( $vars['tables'] as $m )
                $menu[] = array( 'slug' => "/admin/$m", 'title' => $m );

            $typelist = ( $table === 'media' ) ?
                [ 'gallery', 'product', 'media' ] : null;

            $alertmsg = null;
            if ( isset( $_SESSION['alertmsg'] )) {
                $alertmsg = $_SESSION['alertmsg'];
                unset( $_SESSION['alertmsg'] );
            }
            $username = $_SESSION['username'];
            include( $vars['htmldir'] . "admin/header.php" );
            include( $vars['htmldir'] . "admin/tab$table.php" );
            include( $vars['htmldir'] . "admin/footer.php" );

            return [ 'code' => 200 ];
        }
        return [ 'code' => 405 ];
    }

    function renderEdit ( $uri, $table, $id, $vars ) {

        if ( !in_array( $table, $vars['tables'] ))
            return [ 'code' => 500 ];

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => '/admin/login' ];

        if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
            $conn = Model::dbConnect( $vars['database'] );
            $page = Model::sqlFetch( $conn,
                "SELECT * FROM $table WHERE id = ?", array( $id ));
            $langlist = ( $table === 'users' ) ? null :
                Model::sqlFetchColumn( $conn, "SELECT DISTINCT lang FROM website" );
            $medialist = ( $table === 'users' || $table === 'website' ) ? null :
                Model::sqlFetchColumn( $conn, 'SELECT DISTINCT media FROM media' );
            $sourcelist = ( $table === 'users' || $table === 'website' ) ? null :
                Model::sqlFetchAll( $conn, "SELECT id, title FROM $table" );
            $conn = null;

            if ( $page === false )
                return [ 'code' => 404 ];

            $menu = array();
            foreach ( $vars['tables'] as $m )
                $menu[] = array( 'slug' => "/admin/$m", 'title' => $m );

            $csrf = isset( $_SESSION['csrf'] ) ? $_SESSION['csrf'] :
                $csrf = Sesija::sessionToken();

            $username = $_SESSION['username'];
            include( $vars['htmldir'] . "admin/header.php" );
            include( $vars['htmldir'] . "admin/edit$table.php" );
            include( $vars['htmldir'] . "admin/footer.php" );
            return [ 'code' => 200 ];
        }
        if ( $_SERVER['REQUEST_METHOD'] !== 'POST' )
            return [ 'code' => 405 ];

        $idval = intval( $id );
        $_SESSION['alertmsg'] = "Error editing record from table '$table'";

        if ( isset( $_POST['csrf'] ) && isset( $_SESSION['csrf'] )
            && hash_equals( $_POST['csrf'], $_SESSION['csrf'] ) && $idval > 0 )
        {
            if ( isset( $_POST['save'] )) {
                $_SESSION['alertmsg'] = "Error saving record to table '$table'";
                $result = Model::saveRecord( $vars['database'], $table, $idval );
                if ( $result === true )
                    $_SESSION['alertmsg'] = "Record saved to table '$table'";
            } else if ( isset( $_POST['delete'] )) {
                $_SESSION['alertmsg'] = "Error deleting record from table '$table'";
                $result = Model::deleteRecord( $vars['database'], $table, $idval );
                if ( $result === 1 )
                    $_SESSION['alertmsg'] = "Record deleted from table '$table'";
            }
        }
        unset( $_SESSION['csrf'] );
        return [ 'code' => 302, 'path' => "/admin/$table" ];
    }

    function renderCreate ( $uri, $table, $vars ) {

        if ( !in_array( $table, $vars['tables'] ))
            return [ 'code' => 500 ];

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => '/admin/login' ];

        if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
            $langlist = null;
            $medialist = null;
            if ( $table !== 'website' && $table !== 'users' ) {
                $conn = Model::dbConnect( $vars['database'] );
                $langlist = Model::sqlFetchColumn(
                    $conn, "SELECT DISTINCT lang FROM website" );
                $medialist = Model::sqlFetchColumn(
                    $conn, 'SELECT DISTINCT media FROM media' );
                if ( $table !== 'staff' && $table !== 'media' ) {
                    $sourcelist = Model::sqlFetchAll(
                        $conn, "SELECT id, sourceid, title FROM $table" );
                } else {
                    $sourcelist = Model::sqlFetchAll(
                        $conn, "SELECT id, title FROM $table" );
                }
                $conn = null;
            }
            $menu = array();
            foreach ( $vars['tables'] as $m )
                $menu[] = array( 'slug' => "/admin/$m", 'title' => $m );

            $csrf = Sesija::sessionToken();
            $username = $_SESSION['username'];
            include( $vars['htmldir'] . "admin/header.php" );
            include( $vars['htmldir'] . "admin/new$table.php" );
            include( $vars['htmldir'] . "admin/footer.php" );

            return [ 'code' => 200 ];
        }
        if ( $_SERVER['REQUEST_METHOD'] !== 'POST' )
            return [ 'code' => 405 ];

        $_SESSION['alertmsg'] = "Error creating new record for table '$table'";

        if ( isset( $_POST['csrf'] ) && isset( $_SESSION['csrf'] )
            && hash_equals( $_POST['csrf'], $_SESSION['csrf'] )
            && isset( $_POST['save'] ))
        {
            $result = Model::saveRecord( $vars['database'], $table, null );
            if ( $result === true )
                $_SESSION['alertmsg'] = "New record created for table '$table'";
        }
        unset( $_SESSION['csrf'] );
        return [ 'code' => 302, 'path' => "/admin/$table" ];
    }

    function renderUpload ( $uri, $vars ) {

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => '/admin/login' ];

        if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
            $conn = Model::dbConnect( $vars['database'] );
            $langlist = Model::sqlFetchColumn(
                $conn, "SELECT DISTINCT lang FROM website" );
            $conn = null;

            $menu = array();
            foreach ( $vars['tables'] as $m )
                $menu[] = array( 'slug' => "/admin/$m", 'title' => $m );

            $csrf = Sesija::sessionToken();
            $username = $_SESSION['username'];
            $table = 'upload';
            include( $vars['htmldir'] . "admin/header.php" );
            include( $vars['htmldir'] . "admin/upload.php" );
            include( $vars['htmldir'] . "admin/footer.php" );

            return [ 'code' => 200 ];
        }
        if ( $_SERVER['REQUEST_METHOD'] !== 'POST' )
            return [ 'code' => 405 ];

        $_SESSION['alertmsg'] = "Error uploading new image for table 'media'! ";

        if ( isset( $_POST['csrf'] ) && isset( $_SESSION['csrf'] )
            && hash_equals( $_POST['csrf'], $_SESSION['csrf'] )
            && isset( $_POST['upload'] )
            && isset( $_FILES['userfile']['name'] )
            && isset( $_FILES['userfile']['tmp_name'] ))
        {
            $_SESSION['alertmsg'] .= "Is uploaded file?";

            if ( is_uploaded_file( $_FILES['userfile']['tmp_name'] )) {
                $name = mb_strtolower(
                    basename( $_FILES['userfile']['name'] ), 'UTF-8' );
                $filename = preg_replace( '/[[:space:]]+/u', '-', $name );
                $uploadfile = $vars['uploaddir'] . "/upload/$filename";

                if ( file_exists( $uploadfile )) {
                    $_SESSION['alertmsg'] = "File exists, rename image file before upload";
                } else {
                    $_SESSION['alertmsg'] .= "MIME content type?";
                    $mimetype = mime_content_type( $_FILES['userfile']['tmp_name'] );
                    if ( in_array( $mimetype, ['image/jpeg', 'image/png'] )) {
                        $srcfile = $_FILES['userfile']['tmp_name'];
                        $dstfile = $uploadfile;
                        $_SESSION['alertmsg'] .= "Move uploaded file? Source: '$srcfile'. Destination: '$dstfile'";
                        if ( move_uploaded_file( $_FILES['userfile']['tmp_name'], $uploadfile )) {
                            $result = Model::saveUpload( $vars['database'], $filename );
                            if ( $result === true )
                                $_SESSION['alertmsg'] = "Image '$filename' uploaded for table 'media'";
                            else
                                $_SESSION['alertmsg'] = "Save to database?";
                        }
                    } else {
                        $_SESSION['alertmsg'] = "Unsupported image type, convert to jpg or png before upload";
                    }
                }
            }
        }
        unset( $_SESSION['csrf'] );
        return [ 'code' => 302, 'path' => "/admin/media" ];
    }

    function renderCleanup ( $uri, $vars ) {

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => "/admin/login" ];

        $conn = Model::dbConnect( $vars['database'] );
        $medialist = Model::sqlFetchColumn( $conn, 'SELECT DISTINCT media FROM media' );
        $conn = null;

        $uploadlist = glob( $vars['uploaddir'] . '/upload/*' );

        $_SESSION['alertmsg'] = "No unused images";
        $count = 0;
        $delfile = array();

        foreach ( $uploadlist as $file ) {
            if ( is_file( $file )) {
                $name = '/upload/' . basename( $file );
                if ( !in_array( $name, $medialist )) {
                    unlink( $file );
                    $count++;
                    $delfile[] = $name;
                }
            }
        }
        if ( $count > 0 ) {
            $_SESSION['alertmsg'] = "Deleted $count unused image(s): " . $delfile[0];
            array_shift( $delfile );
            foreach ( $delfile as $file )
                $_SESSION['alertmsg'] .= ", $file";
        }
        return [ 'code' => 302, 'path' => "/admin/media" ];
    }

    public function renderSqlite( $vars ) {

        if ( !Sesija::isAdmin( $vars['database'] ))
            return [ 'code' => 302, 'path' => '/admin/login' ];

        include __DIR__.'/adminer/sqlite.php';

        return [ 'code' => 200 ];
    }
}
