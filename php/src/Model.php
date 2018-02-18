<?php
namespace Sustav\Model;

use PDO;
use Ausi\SlugGenerator\SlugGenerator;

/**
 * Model sadržaja.
 */
class Model
{
    //############################################################################
    // Database functions

    public static function dbConnect ( $db ) {
        return new PDO( $db['dsn'], $db['user'], $db['pass'], $db['options'] );
    }

    // Example usage:
    // Open connection:
    // $conn = dbConnect( $db );
    //
    // Prepare and execute:
    // $sql = 'SELECT * FROM table WHERE attr = ?';
    // $st = $conn->prepare( $sql );
    // $st->execute( array( $attr ));
    //
    // Fetch single row:
    // $result = $st->fetch();
    // Result: array( 'attr' => 'value', ... )
    //
    // Fetch all rows:
    // $result = $st->fetchAll();
    // Result: array( array( 'attr' => 'value', ... ), ... )
    //
    // Fetch single attribute:
    // $sql = 'SELECT attr FROM table';
    // $st = $conn->prepare( $sql );
    // $st->execute();
    // $result = $st->fetchAll( PDO::FETCH_COLUMN );
    // Result: array( 'value', ... )
    //
    // Close connection:
    // $conn = null;

    public static function sqlFetch ( $conn, $sql, $params = null ) {
        $st = $conn->prepare( $sql );
        if ( isset( $params )) $st->execute( $params );
        else $st->execute();
        return $st->fetch();
    }

    public static function sqlFetchAll ( $conn, $sql, $params = null ) {
        $st = $conn->prepare( $sql );
        if ( isset( $params )) $st->execute( $params );
        else $st->execute();
        return $st->fetchAll();
    }

    public static function sqlFetchColumn ( $conn, $sql, $params = null ) {
        $st = $conn->prepare( $sql );
        if ( isset( $params )) $st->execute( $params );
        else $st->execute();
        return $st->fetchAll( PDO::FETCH_COLUMN );
    }

    public static function sqlFetchSingle ( $conn, $sql, $params = null ) {
        $st = $conn->prepare( $sql );
        if ( isset( $params )) $st->execute( $params );
        else $st->execute();
        $result = $st->fetchAll( PDO::FETCH_COLUMN );
        if ( $result !== false && isset( $result[0] ))
            return $result[0];
        return false;
    }

    public static function getLangnav ( $conn, $default, $lang, $table, $recordid, $sourceid ) {
        $result = self::sqlFetchAll( $conn,
            'SELECT lang FROM website WHERE NOT lang = ? AND enabled = ?',
            array( $lang, 'yes' ));
        if ( $result === false )
            return null;

        $recid = intval( $recordid );
        $srcid = intval( $sourceid );
        $tabslug = "";

        if ( in_array( $table, [ 'blog', 'article' ] )) {
            $tabslug = "/$table";
        }

        if ( $srcid == 0 ) {

            foreach( $result as &$item ) {
                $slug = self::sqlFetch( $conn,
                    "SELECT slug FROM $table WHERE lang = ? AND sourceid = $recid",
                    array( $item['lang'] ));
                if ( $slug === false ) {
                    if ( $item['lang'] === $default )
                        $item['slug'] = $tabslug;
                    else
                        $item['slug'] = '/' . $item['lang'] . $tabslug;
                } else {
                    if ( $item['lang'] === $default )
                        $item['slug'] = $tabslug . $slug['slug'];
                    else
                        $item['slug'] = '/' . $item['lang'] . $tabslug . $slug['slug'];
                }
            }
        } else if ( $srcid > 0 ) {

            foreach( $result as &$item ) {
                $slug = self::sqlFetch( $conn,
                    "SELECT slug FROM $table WHERE lang = ? AND sourceid = $srcid",
                    array( $item['lang'] ));
                if ( $slug === false ) {
                    $slug = self::sqlFetch( $conn,
                        "SELECT slug FROM $table WHERE lang = ? AND id = $srcid",
                        array( $item['lang'] ));
                    if ( $slug === false ) {
                        if ( $item['lang'] === $default )
                            $item['slug'] = $tabslug;
                        else
                            $item['slug'] = '/' . $item['lang'] . $tabslug;
                    } else {
                        if ( $item['lang'] === $default )
                            $item['slug'] = $tabslug . $slug['slug'];
                        else
                            $item['slug'] = '/' . $item['lang'] . $tabslug . $slug['slug'];
                    }
                } else {
                    if ( $item['lang'] === $default )
                        $item['slug'] = $tabslug . $slug['slug'];
                    else
                        $item['slug'] = '/' . $item['lang'] . $tabslug . $slug['slug'];
                }
            }
        } else {

            foreach( $result as &$item ) {
                if ( $item['lang'] === $default )
                    $item['slug'] = $tabslug;
                else
                    $item['slug'] = '/' . $item['lang'] . $tabslug;
            }
        }
        return $result;
    }

    public static function getSourceTitle ( $db, $table, $id ) {

        $sourceid = intval( $id );
        if ( $sourceid == 0 )
            return '-';

        $conn = self::dbConnect( $db );
        $title = self::sqlFetchSingle( $conn, "SELECT title FROM $table WHERE id=$sourceid" );
        $conn = null;

        return $title;
    }

    public static function deleteRecord ( $db, $table, $id ) {
        $conn = self::dbConnect( $db );
        $result = $conn->exec( "DELETE FROM $table WHERE id=$id" );
        $conn = null;
        return $result;
    }

    public static function saveUpload ( $db, $filename ) {
        $sqlcol = array();
        $params = array();

        $sqlcol[] = 'datum';
        $params[':datum'] = date( 'Y-m-d', time());

        $sqlcol[] = 'media';
        $params[':media'] = "/upload/$filename";

        foreach ( ['lang','display','title','summary'] as $key ) {
            $sqlcol[] = $key;
            $params[":$key"] = filterInput( $_POST[$key] );
        }
        $list = array();
        $values = array();
        foreach ( $sqlcol as $key ) { $list[] = $key; $values[] = ":$key"; }
        $colset = implode( ',', $list );
        $colval = implode( ',', $values );
        $sql = "INSERT INTO media (id,$colset) VALUES (NULL,$colval)";

        $conn = self::dbConnect( $db );
        $st = $conn->prepare( $sql );
        $result = $st->execute( $params );
        $conn = null;

        return $result;
    }

    public static function saveRecord ( $db, $table, $id = null ) {
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
        $records = array(
            'address', 'city', 'comment', /*'content',*/ 'country',
            /*'datum',*/ 'description', 'display', 'email', 'enabled',
            'keywords', 'lang', 'logo', 'media', 'menuid', 'name',
            /*'password',*/ 'phone', /*'slug',*/ 'summary', 'sourceid',
            'template', 'title', 'username', 'zipcode'
        );
        $sqlcol = array();
        $params = array();

        $sqlcol[] = 'datum';
        $params[':datum'] = date( 'Y-m-d', time());

        foreach ( $records as $item ) {
            if ( isset( $_POST[$item] )) {
                $sqlcol[] = $item;
                $params[":$item"] = filterInput( $_POST[$item] );
            }
        }
        if ( !in_array( $table, ['website','users','media'] )) {
            $sqlcol[] = 'slug';
            $params[':slug'] = '/';
            if ( $table === 'page' ) {
                if ( $params[':template'] !== 'home' ) {
                    /*
                    $params[':slug'] .= preg_replace( '/[[:space:]]+/u', '-',
                        mb_strtolower( trim( $params[':title'] ), 'UTF-8' ));
                     */
                    $generator = new SlugGenerator();
                    $params[':slug'] .= $generator->generate( $params[':title'] );
                }
            } else {
                /*
                $params[':slug'] .= preg_replace( '/[[:space:]]+/u', '-',
                    mb_strtolower( trim( $params[':title'] ), 'UTF-8' ));
                 */
                $generator = new SlugGenerator();
                $params[':slug'] .= $generator->generate( $params[':title'] );
            }
        }
        if ( isset( $_POST['content'] )) {
            $sqlcol[] = 'content';
            $params[':content'] = purifyHtml( $_POST['content'] );
        }
        if ( isset( $_POST['password'] )) {
            $sqlcol[] = 'password';
            $params[':password'] = password_hash(
                $_POST['password'], PASSWORD_DEFAULT );
        }
        $sql = '';
        if ( isset( $id )) {
            $params[':id'] = $id;
            $list = array();
            foreach ( $sqlcol as $key ) { $list[] = "$key=:$key"; }
            $colset = implode( ',', $list );
            $sql = "UPDATE $table SET $colset WHERE id=:id";
        } else {
            $list = array();
            $values = array();
            foreach ( $sqlcol as $key ) { $list[] = $key; $values[] = ":$key"; }
            $colset = implode( ',', $list );
            $colval = implode( ',', $values );
            $sql = "INSERT INTO $table (id,$colset) VALUES (NULL,$colval)";
        }
        $conn = self::dbConnect( $db );
        $st = $conn->prepare( $sql );
        $result = $st->execute( $params );
        $conn = null;
        return $result;
    }
}
