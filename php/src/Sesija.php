<?php
namespace Sustav\Upravljac;

use Sustav\Model\Model;

/**
 * Sesija korisnika sustava.
 */
class Sesija
{
    /**
     * Postavi sigurnosni token za sesiju.
     *
     * @return string Token.
     */
    public static function sessionToken() : string
    {
        session_regenerate_id();
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        return $_SESSION['csrf'];
    }

    /**
     * Dohvati podatke o korisniku iz baze podataka.
     *
     * @param array $db Veza s bazom podataka.
     * @param string $username Ime korisnika.
     * @return array Polje podataka o korisniku ili prazno polje.
     */
    public static function getUser(array $db, string $username) : array
    {
        $conn = Model::dbConnect($db);
        $sql = 'SELECT username, password FROM users WHERE username = ?';
        $st = $conn->prepare($sql);
        $st->execute([$username]);
        $result = $st->fetch();
        $conn = null;
        if ($result) {
            return $result;
        }
        return [];
    }

    /**
     * Korisnik je urednik sadržaja?
     *
     * @param array $db Veza s bazom podataka.
     * @return bool Ako je korisnik urednik TRUE, inače FALSE.
     */
    public static function isAdmin(array $db) : bool
    {
        if (isset($_SESSION['username'])) {
            if (!empty(self::getUser($db, $_SESSION['username']))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Provjeri unesenu lozinku korisnika s onom u bazi podataka.
     *
     * @param array $db Veza s bazom podataka.
     * @return bool Ako je lozinka ispravna TRUE, inače FALSE.
     */
    public static function isPassword(array $db) : bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['username']) && isset($_POST['password'])
            && isset($_POST['csrf']) && isset($_SESSION['csrf'])) {
            // Validate login form
            if (hash_equals($_POST['csrf'], $_SESSION['csrf'])) {
                $user = self::getUser($db, $_POST['username']);
                if (!empty($user) && password_verify($_POST['password'], $user['password'])) {
                    unset($_SESSION['csrf']);
                    $_SESSION['username'] = $user['username'];
                    session_regenerate_id();
                    return true;
                }
            }
        }
        return false;
    }
}
