<?php

//############################################################################
// Utility functions

function filterInput ( $str, $length = 255 ) {
    return preg_replace( "/[^\pL0-9 \+\/\.\,\-\_\'\"\@\?\!\:\$\(\)]/u",
        "", mb_substr( trim( $str ), 0, $length, 'UTF-8' ));
}

function escapeOutput ( $str ) {
    return htmlspecialchars( $str, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
}

function echoOutput ( $str ) {
    echo htmlspecialchars( $str, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
}

function purifyHtml ( $html ) {
    // HtmlPurifier PHP biblioteka
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier( $config );
    return $purifier->purify( $html );
}

function echoHtml ( $html ) {
    echo purifyHtml( $html );
}

function getLangName ( $langcode ) {
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
    if ( isset( $language_codes[$langcode] ))
        return $language_codes[$langcode];
    return 'None';
}
