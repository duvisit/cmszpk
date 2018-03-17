<?php
namespace Sustav;

/**
 * Pomoćne funkcije.
 */
class Funkcije
{
    /**
     * Pretvori grešku u iznimku.
     *
     * @see http://php.net/set_error_handler Example #1 Use set_error_handler()
     * to change error messages into ErrorException.
     *
     * @throws \ErrorException
     */
    public static function errorHandler($severity, $message, $file, $line)
    {
        if (!(error_reporting() & $severity)) {
            // This error code is not included in error_reporting
            return;
        }
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    /**
     * Prijevod poruka sustava.
     *
     * @param string $str Ulazna poruka.
     * @param string $lang Jezik prijevoda.
     * @return string Prevedena poruka ili ulazna poruka.
     */
    public static function translate(string $str, string $lang) : string
    {
        $data = [
            'Facebook feed not available' => ['hr' => 'Facebook objave nisu dostupne'],
            'News' => ['hr' => 'Novosti'],
            'Powered by' => ['hr' => 'Omogućuje'],
            'Where to find us' => ['hr' => 'Gdje se nalazimo']
        ];
        if (!empty($data[$str][$lang])) {
            return $data[$str][$lang];
        }
        return $str;
    }

    /**
     * Promijeni tekst prijevoda za sigurnu upotrebu prema pravilima html
     * standarda za kodiranje znakova.
     *
     * @see \Sustav\Funkcije::escapeOutput()
     * @see \Sustav\Funkcije::translate()
     *
     * @param string $str Ulazna poruka.
     * @param string $lang Jezik prijevoda.
     * @return string Tekst kodiran za html.
     */
    public static function escapeTrans(string $str, string $lang) : string
    {
        return self::escapeOutput(self::translate($str, $lang));
    }

    /**
     * Pokreni ispis Facebook objava.
     *
     * @see \Sustav\Model\Facebook
     *
     * @param int $num Broj objava za prikaz.
     * @param string $lang Jezik stranice objava.
     */
    public static function facebookFeed(int $num, string $lang) : void
    {
        \Sustav\Model\Facebook::feed($num, $lang);
    }

    /**
     * Filtriraj ulazni tekst.
     *
     * Dopušteni znakovi:
     * slova (Unicode), brojevi (0-9), razmak ( ), plus (+), minus (-), točka (.),
     * zarez (,), jednostruki (') i dvostruki (") navodnici, at (@), zagrade (()),
     * uskličnik (!), upitnik (?), dvotočka (:).
     *
     * @param string $str Ulazni tekst.
     * @param int $length Dopušteni broj znakova teksta.
     * @return string Filtrirani tekst.
     */
    public static function filterInput(string $str, int $length = 255) : string
    {
        return preg_replace(
            "/[^\pL0-9 \+\-\.\,\'\"\@\(\)\!\?\:]/u",
            "",
            mb_substr(trim($str), 0, $length, 'UTF-8')
        );
    }

    /**
     * Promijeni tekst za sigurnu upotrebu prema pravilima html standarda za
     * kodiranje nedopuštenih znakova.
     *
     * @see http://php.net/htmlspecialchars
     *
     * @param string $str Tekst.
     * @return string Tekst kodiran za html.
     */
    public static function escapeOutput(string $str) : string
    {
        return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Ispiši tekst za sigurnu upotrebu prema pravilima html standarda za kodiranje
     * nedopuštenih znakova.
     *
     * @see \Sustav\Funkcije::escapeOutput()
     *
     * @param string $str Tekst.
     */
    public static function echoOutput(string $str) : void
    {
        echo self::escapeOutput($str);
    }

    /**
     * Pročisti html od sigurnosnih grešaka.
     *
     * Metoda koristi [HtmlPurifier](http://htmlpurifier.org/).
     *
     * @param string $html Html.
     * @return string Pročišćeni html.
     */
    public static function purifyHtml(string $html) : string
    {
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        return $purifier->purify($html);
    }

    /**
     * Drugo ime za funkciju purifyHtml().
     *
     * @see \Sustav\Funkcije::purifyHtml()
     *
     * @param string $html Html.
     * @return string Pročišćeni html.
     */
    public static function escapeHtml(string $html) : string
    {
        return self::purifyHtml($html);
    }

    /**
     * Ispiši pročišćeni html.
     *
     * @see Funkcije::purifyHtml()
     *
     * @param string $html Html.
     */
    public static function echoHtml(string $html) : void
    {
        echo self::purifyHtml($html);
    }

    /**
     * Dohvati puni naziv jezika prema skraćenom nazivu.
     *
     * @param string $langcode Skraćeni naziv.
     * @return string Puni naziv jezika ili 'None'.
     */
    public static function getLangName(string $langcode) : string
    {
        $language_codes = array(
            'en' => 'English', 'aa' => 'Afar', 'ab' => 'Abkhazian', 'af' =>
            'Afrikaans', 'am' => 'Amharic', 'ar' => 'Arabic', 'as' => 'Assamese',
            'ay' => 'Aymara', 'az' => 'Azerbaijani', 'ba' => 'Bashkir', 'be' =>
            'Byelorussian', 'bg' => 'Bulgarian', 'bh' => 'Bihari', 'bi' =>
            'Bislama', 'bn' => 'Bengali/Bangla', 'bo' => 'Tibetan', 'br' =>
            'Breton', 'ca' => 'Catalan', 'co' => 'Corsican', 'cs' => 'Czech', 'cy'
            => 'Welsh', 'da' => 'Danish', 'de' => 'German', 'dz' => 'Bhutani', 'el'
            => 'Greek', 'eo' => 'Esperanto', 'es' => 'Spanish', 'et' => 'Estonian',
            'eu' => 'Basque', 'fa' => 'Persian', 'fi' => 'Finnish', 'fj' => 'Fiji',
            'fo' => 'Faeroese', 'fr' => 'French', 'fy' => 'Frisian', 'ga' =>
            'Irish', 'gd' => 'Scots/Gaelic', 'gl' => 'Galician', 'gn' => 'Guarani',
            'gu' => 'Gujarati', 'ha' => 'Hausa', 'hi' => 'Hindi', 'hr' =>
            'Croatian', 'hu' => 'Hungarian', 'hy' => 'Armenian', 'ia' =>
            'Interlingua', 'ie' => 'Interlingue', 'ik' => 'Inupiak', 'in' =>
            'Indonesian', 'is' => 'Icelandic', 'it' => 'Italian', 'iw' => 'Hebrew',
            'ja' => 'Japanese', 'ji' => 'Yiddish', 'jw' => 'Javanese', 'ka' =>
            'Georgian', 'kk' => 'Kazakh', 'kl' => 'Greenlandic', 'km' =>
            'Cambodian', 'kn' => 'Kannada', 'ko' => 'Korean', 'ks' => 'Kashmiri',
            'ku' => 'Kurdish', 'ky' => 'Kirghiz', 'la' => 'Latin', 'ln' =>
            'Lingala', 'lo' => 'Laothian', 'lt' => 'Lithuanian', 'lv' =>
            'Latvian/Lettish', 'mg' => 'Malagasy', 'mi' => 'Maori', 'mk' =>
            'Macedonian', 'ml' => 'Malayalam', 'mn' => 'Mongolian', 'mo' =>
            'Moldavian', 'mr' => 'Marathi', 'ms' => 'Malay', 'mt' => 'Maltese',
            'my' => 'Burmese', 'na' => 'Nauru', 'ne' => 'Nepali', 'nl' => 'Dutch',
            'no' => 'Norwegian', 'oc' => 'Occitan', 'om' => '(Afan)/Oromoor/Oriya',
            'pa' => 'Punjabi', 'pl' => 'Polish', 'ps' => 'Pashto/Pushto', 'pt' =>
            'Portuguese', 'qu' => 'Quechua', 'rm' => 'Rhaeto-Romance', 'rn' =>
            'Kirundi', 'ro' => 'Romanian', 'ru' => 'Russian', 'rw' =>
            'Kinyarwanda', 'sa' => 'Sanskrit', 'sd' => 'Sindhi', 'sg' => 'Sangro',
            'sh' => 'Serbo-Croatian', 'si' => 'Singhalese', 'sk' => 'Slovak', 'sl'
            => 'Slovenian', 'sm' => 'Samoan', 'sn' => 'Shona', 'so' => 'Somali',
            'sq' => 'Albanian', 'sr' => 'Serbian', 'ss' => 'Siswati', 'st' =>
            'Sesotho', 'su' => 'Sundanese', 'sv' => 'Swedish', 'sw' => 'Swahili',
            'ta' => 'Tamil', 'te' => 'Tegulu', 'tg' => 'Tajik', 'th' => 'Thai',
            'ti' => 'Tigrinya', 'tk' => 'Turkmen', 'tl' => 'Tagalog', 'tn' =>
            'Setswana', 'to' => 'Tonga', 'tr' => 'Turkish', 'ts' => 'Tsonga', 'tt'
            => 'Tatar', 'tw' => 'Twi', 'uk' => 'Ukrainian', 'ur' => 'Urdu', 'uz' =>
            'Uzbek', 'vi' => 'Vietnamese', 'vo' => 'Volapuk', 'wo' => 'Wolof', 'xh'
            => 'Xhosa', 'yo' => 'Yoruba', 'zh' => 'Chinese', 'zu' => 'Zulu',
        );
        if (isset($language_codes[$langcode])) {
            return $language_codes[$langcode];
        }
        return 'None';
    }
}
