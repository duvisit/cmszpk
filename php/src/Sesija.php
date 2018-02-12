<?php
namespace Sustav\Upravljac;

use Sustav\Model\Model;

/**
 * Sesija korisnika sustava.
 */
class Sesija
{
    //############################################################################
    // Administration

    public static function sessionToken() {
        session_regenerate_id();
        $_SESSION['csrf'] = bin2hex( random_bytes( 32 ));
        return $_SESSION['csrf'];
    }

    public static function getUser ( $db, $username ) {
        $conn = Model::dbConnect( $db );
        $sql = 'SELECT username, password FROM users WHERE username = ?';
        $st = $conn->prepare( $sql );
        $st->execute( [$username] );
        $result = $st->fetch();
        $conn = null;
        if ( $result !== false && !empty( $result ))
            return $result;
        return false;
    }

    public static function isAdmin ( $db ) {
        if ( isset( $_SESSION['username'] )) {
            if ( self::getUser( $db, $_SESSION['username'] ) !== false )
                return true;
        }
        return false;
    }

    public static function isPassword ( $db ) {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset( $_POST['username'] ) && isset( $_POST['password'] )
            && isset( $_POST['csrf'] ) && isset( $_SESSION['csrf'] ))
        {
            // Validate login form
            if ( hash_equals( $_POST['csrf'], $_SESSION['csrf'] )) {
                $user = self::getUser( $db, $_POST['username'] );

                if ( $user !== false
                    && password_verify( $_POST['password'], $user['password'] ))
                {
                    unset( $_SESSION['csrf'] );
                    $_SESSION['username'] = $user['username'];
                    session_regenerate_id();
                    return true;
                }
            }
        }
        return false;
    }
}
