<!-- website -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<form id="article" class="uk-form uk-form-horizontal"
    action="<?php echoOutput( $uri ); ?>" method="post">

<input type="hidden" name="csrf" value="<?php echoOutput( $csrf ); ?>">

<fieldset>
<legend>Record</legend>

<div class="uk-form-row">
<label class="uk-form-label" for="lang">Language</label>
<div class="uk-form-controls">
<select id="lang" name="lang">
    <option value="en">English</option> <option value="aa">Afar</option> <option value="ab">Abkhazian</option> <option value="af">Afrikaans</option>
    <option value="am">Amharic</option> <option value="ar">Arabic</option> <option value="as">Assamese</option> <option value="ay">Aymara</option>
    <option value="az">Azerbaijani</option> <option value="ba">Bashkir</option> <option value="be">Byelorussian</option> <option value="bg">Bulgarian</option>
    <option value="bh">Bihari</option> <option value="bi">Bislama</option> <option value="bn">Bengali/Bangla</option> <option value="bo">Tibetan</option>
    <option value="br">Breton</option> <option value="ca">Catalan</option> <option value="co">Corsican</option> <option value="cs">Czech</option>
    <option value="cy">Welsh</option> <option value="da">Danish</option> <option value="de">German</option> <option value="dz">Bhutani</option>
    <option value="el">Greek</option> <option value="eo">Esperanto</option> <option value="es">Spanish</option> <option value="et">Estonian</option>
    <option value="eu">Basque</option> <option value="fa">Persian</option> <option value="fi">Finnish</option> <option value="fj">Fiji</option>
    <option value="fo">Faeroese</option> <option value="fr">French</option> <option value="fy">Frisian</option> <option value="ga">Irish</option>
    <option value="gd">Scots/Gaelic</option> <option value="gl">Galician</option> <option value="gn">Guarani</option> <option value="gu">Gujarati</option>
    <option value="ha">Hausa</option> <option value="hi">Hindi</option> <option value="hr">Croatian</option> <option value="hu">Hungarian</option>
    <option value="hy">Armenian</option> <option value="ia">Interlingua</option> <option value="ie">Interlingue</option> <option value="ik">Inupiak</option>
    <option value="in">Indonesian</option> <option value="is">Icelandic</option> <option value="it">Italian</option> <option value="iw">Hebrew</option>
    <option value="ja">Japanese</option> <option value="ji">Yiddish</option> <option value="jw">Javanese</option> <option value="ka">Georgian</option>
    <option value="kk">Kazakh</option> <option value="kl">Greenlandic</option> <option value="km">Cambodian</option> <option value="kn">Kannada</option>
    <option value="ko">Korean</option> <option value="ks">Kashmiri</option> <option value="ku">Kurdish</option> <option value="ky">Kirghiz</option>
    <option value="la">Latin</option> <option value="ln">Lingala</option> <option value="lo">Laothian</option> <option value="lt">Lithuanian</option>
    <option value="lv">Latvian/Lettish</option> <option value="mg">Malagasy</option> <option value="mi">Maori</option> <option value="mk">Macedonian</option>
    <option value="ml">Malayalam</option> <option value="mn">Mongolian</option> <option value="mo">Moldavian</option> <option value="mr">Marathi</option>
    <option value="ms">Malay</option> <option value="mt">Maltese</option> <option value="my">Burmese</option> <option value="na">Nauru</option>
    <option value="ne">Nepali</option> <option value="nl">Dutch</option> <option value="no">Norwegian</option> <option value="oc">Occitan</option>
    <option value="om">(Afan)/Oromoor/Oriya</option> <option value="pa">Punjabi</option> <option value="pl">Polish</option> <option value="ps">Pashto/Pushto</option>
    <option value="pt">Portuguese</option> <option value="qu">Quechua</option> <option value="rm">Rhaeto-Romance</option> <option value="rn">Kirundi</option>
    <option value="ro">Romanian</option> <option value="ru">Russian</option> <option value="rw">Kinyarwanda</option> <option value="sa">Sanskrit</option>
    <option value="sd">Sindhi</option> <option value="sg">Sangro</option> <option value="sh">Serbo-Croatian</option> <option value="si">Singhalese</option>
    <option value="sk">Slovak</option> <option value="sl">Slovenian</option> <option value="sm">Samoan</option> <option value="sn">Shona</option>
    <option value="so">Somali</option> <option value="sq">Albanian</option> <option value="sr">Serbian</option> <option value="ss">Siswati</option>
    <option value="st">Sesotho</option> <option value="su">Sundanese</option> <option value="sv">Swedish</option> <option value="sw">Swahili</option>
    <option value="ta">Tamil</option> <option value="te">Tegulu</option> <option value="tg">Tajik</option> <option value="th">Thai</option>
    <option value="ti">Tigrinya</option> <option value="tk">Turkmen</option> <option value="tl">Tagalog</option> <option value="tn">Setswana</option>
    <option value="to">Tonga</option> <option value="tr">Turkish</option> <option value="ts">Tsonga</option> <option value="tt">Tatar</option>
    <option value="tw">Twi</option> <option value="uk">Ukrainian</option> <option value="ur">Urdu</option> <option value="uz">Uzbek</option>
    <option value="vi">Vietnamese</option> <option value="vo">Volapuk</option> <option value="wo">Wolof</option> <option value="xh">Xhosa</option>
    <option value="yo">Yoruba</option> <option value="zh">Chinese</option> <option value="zu">Zulu</option> </select>
</select>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="enabled">Enabled</label>
<div class="uk-form-controls">
<select id="enabled" name="enabled">
    <option value="yes">Yes</option>
    <option value="no">No</option>
</select>
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="name">Name</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="name" name="name"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="address">Address</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="address" name="address"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="zipcode">Postal code</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="zipcode" name="zipcode"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="city">City</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="city" name="city"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="country">Country</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="country" name="country"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="phone">Phone</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="phone" name="phone"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="logo">Logo</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="logo" name="logo"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="description">Description</label>
<div class="uk-form-controls">
<input class="uk-form-width-large" required
    type="text" id="description" name="description"
    value="">
</div>
</div>

<div class="uk-form-row">
<label class="uk-form-label" for="comment">Comment</label>
<div class="uk-form-controls">
<input class="uk-form-width-large"
    type="text" id="comment" name="comment"
    value="">
</div>
</div>

</fieldset>

<div class="uk-block">
<div class="uk-grid">
<div class="uk-width-medium-1-5">
<input class="uk-button uk-button-primary uk-text-contrast uk-width-1-1"
    type="submit" name="save" value="Save">
</div>
<div class="uk-width-medium-1-5">
<a class="uk-button uk-button-secondary uk-width-1-1"
    href="<?php echoOutput( "/admin/$table" ); ?>">Cancel</a>
</div>
</div>
</div>

</form>

</div>
</div>
</div>

