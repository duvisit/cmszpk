<!-- page -->
<div class="uk-block-content">
<div class="uk-block uk-block-default">
<div class="uk-container uk-container-center">

<h1>Sustav za upravljanje sadržajem</h1>
<h2>Opis sustava i upute za korisnike</h2>

<p>Sustav omogućuje upravljanje sadržajem preko baze podataka koja sadrži sljedeće tablice:</p>
<dl class="uk-description-list-horizontal">
<dt>website</dt><dd>Osnovni podaci web mjesta</dd>
<dt>users</dt><dd>Podaci o korisnicima</dd>
<dt>page</dt><dd>Stranice izbornika</dd>
<dt>blog</dt><dd>Stranice bloga</dd>
<dt>article</dt><dd>Stranice članaka</dd>
<dt>staff</dt><dd>Podaci o djelatnicima</dd>
<dt>media</dt><dd>Podaci o fotografijama</dd>
</dl>

<p>Pregled tablica u sučelju administratora prikazuje samo najvažnije podatke.<p>

<h3>Tablica website</h3>

<p>Definira osnovne podatke o web mjestu. Omogućeno je stvaranje višejezničnog web mjesta (postavka <em>lang</em>).</p>

<h4>Podaci</h4>
<dl class="uk-description-list-horizontal">
<dt>lang</dt><dd>Jezik</dd>
<dt>enabled</dt><dd>Prikaži ovaj jezik posjetiteljima stranice, korisno tijekom izrade stranica na drugom jeziku kada ne želimo prikazati radnu verziju</dd>
<dt>name</dt><dd>Naziv web mjesta, prikazan u podnožju stranice</dd>
<dt>address</dt><dd>Adresa, prikazan u predlošku <em>kontakt</em></dd>
<dt>zipcode</dt><dd>Poštanski broj, prikazan u predlošku <em>kontakt</em></dd>
<dt>city</dt><dd>Grad, prikazan u predlošku <em>kontakt</em></dd>
<dt>country</dt><dd>Država, prikazan u predlošku <em>kontakt</em></dd>
<dt>phone</dt><dd>Telefon, prikazan u predlošku <em>kontakt</em></dd>
<dt>logo</dt><dd>Logo tekst, prikazan u zaglavlju stranice, lijevo</dd>
<dt>description</dt><dd>Opis, prikazan u zaglavlju stranice, desno (gore)</dd>
<dt>comment</dt><dd>Komentar, prikazan u zaglavlju stranice, desno (dolje)</dd>
</dl>

<p>Za osnovni jezik postavljen je hrvatski jezik. Ako su definirani i omogućeni (postavka <em>enabled</em>) drugi jezici, posjetiteljima stranice izbor jezika omogućen je poveznicom na glavnom izborniku.</p>

<p>Primjer, internet adresa i jezik stranice:<p>
<ul>
<li><strong>http://example.com/</strong> naslovnica, hrvatski jezik</li>
<li><strong>http://example.com/en/</strong> naslovnica, engleski jezik</li>
<li><strong>http://example.com/fr/</strong> naslovnica, francuski jezik</li>
</ul>

<p>Klikom na <em>Naziv web mjesta</em> otvara se formular za uređivanje web mjesta.<br>
Klikom na <em>Add new</em> otvara se formular za definiranje novog jezika web mjesta.</p>

<h3>Tablica users</h3>

<p>Omogućuje kontrolu korisnika sučelja administratora.</p>

<h4>Podaci</h4>
<dl class="uk-description-list-horizontal">
<dt>username</dt><dd>Korisničkko ime<dd>
<dt>password</dt><dd>Korisnička lozinka<dd>
<dt>email</dt><dd>Adresa e-pošte korisnika<dd>
</dl>

<p>Klikom na <em>Korisničko ime</em> otvara se formular za uređivanje podataka korisnika.<br>
Klikom na <em>Add new</em> otvara se formular za definiranje novog korisnika.</p>

<h3>Tablica page</h3>

<p>Sadrži podatke o sadržaju i prezentaciji sadržaja stranica web mjesta. Glavni izbornik je lista svih stranica za odgovarajući jezik iz ove tablice.</p>

<h4>Podaci</h4>
<dl class="uk-description-list-horizontal">
<dt>menuid</dt><dd>Redni broj, određuje poredak poveznica na izborniku.</dd>
<dt>lang</dt><dd>Jezik</dd>
<dt>template</dt><dd>Predlošci za prezentaciju</dd>
<dt>featured image</dt><dd>Naslovna slika, preporučene dimenzije su 1200x700 ili 1200x400</dd>
<dt>title</dt><dd>Naslov, prikazan u izborniku</dd>
<dt>summary</dt><dd>Kratki opis stranice (meta podatak)</dd>
<dt>keywords</dt><dd>Ključne riječi stranice (meta podatak)</dd>
<dt>content</dt><dd>Html sadržaj</dd>
</dl>

<p>Klikom na <em>Naslov</em> otvara se formular za uređivanje podataka stranice.<br>
Klikom na <em>Add new</em> otvara se formular za stvaranje nove stranice.</p>

<p><strong>Predlošci</strong></p>
<ul>
<li><strong>home</strong> &mdash; Html sadržaj će biti prikazan kao naslovna stranica za odgovarajući jezik</li>
<li><strong>page</strong> &mdash; Prikaz samo html sadržaja</li>
<li><strong>bloglist</strong> &mdash; Prikaz sadržaja uz listu objava bloga</li>
<li><strong>articlelist</strong> &mdash; Prikaz sadržaja uz listu članaka</li>
<li><strong>stafflist</strong> &mdash; Prikaz sadržaja uz listu djelatnika</li>
<li><strong>gallery</strong> &mdash; Prikaz galerije slika</li>
<li><strong>product</strong> &mdash; Prikaz ponude</li>
<li><strong>contact</strong> &mdash; Prikaz kontakt informacija</li>
</ul>

<h3>Tablica blog, article</h3>

<p>Ove tablice su slične tablici page. Nema predložaka već se sadržaj prikazuje u predlošcima <em>bloglist</em> i <em>articlelist</em>.</p>

<h3>Tablica staff</h3>

<p>Podaci o djelatnicima. Ime, slika i opis prikazani su u predlošku <em>stafflist</em></p>

<p>Klikom na <em>Edit</em> otvara se formular za uređivanje podataka djelatnika.<br>
Klikom na <em>Add new</em> otvara se formular za dodavanje novog djelatnika.</p>

<h3>Tablica media</h3>

<p>Podaci o korištenim slikama. Naslov služi kao opis slike.</p>

<p><strong>Kategorije</strong></p>
<ul>
<li><strong>media</strong> &mdash; Slika se koristi na nekoj od stranica</li>
<li><strong>product</strong> &mdash; Slika se koristi na nekoj od stranica</li>
<li><strong>gallery</strong> &mdash; Osim na nekoj od stranica, slika će biti prikazana u predlošku <em>gallery</em>.</li>
</ul>

<p>Klikom na <em>Edit</em> otvara se formular za uređivanje podataka.<br>
Klikom na <em>Add new</em> otvara se formular za dodavanje nove slike sa servera.<br>
Klikom na <em>Upload</em> otvara se formular za prijenos nove slike s lokalnog računala.<br>
Klikom na <em>Delete unused</em> brišu se nekorištene slike.</p>

<h2>Html editor</h2>

<p>Za ispravan prikaz tekstualnog sadržaja potrebno je koristiti sljedeće 
<em>div</em> oznake i pripadajuće klase (<em>class</em>):
</p>

<textarea id="text-content" name="text-content"
    data-uk-htmleditor="{mode:'tab'}">
&lt;div class="uk-block"&gt;
&lt;div class="uk-container uk-container-center"&gt;

    &lt;h1&gt;Heading 1&lt;/h1&gt;
    &lt;h2&gt;Heading 2&lt;/h2&gt;
    &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus orci 
risus, eleifend id nisl at, sollicitudin aliquam lectus. Nunc lobortis at metus 
eget tristique. Aenean sagittis eleifend diam, sit amet pretium arcu. Ut diam 
ante, aliquam et ligula vitae, varius efficitur nisl. Aenean quis hendrerit 
dolor, convallis molestie felis. Quisque blandit nunc a elit tristique commodo. 
Aenean vel nulla quis mi aliquam fermentum. Duis vitae molestie dui.&lt;/p&gt;

&lt;/div&gt;
&lt;/div&gt;
</textarea>

<p>Za prikaz slika od ruba do ruba potrebno je koristiti sljedeće <em>div</em> 
oznake i pripadajuće klase (<em>class</em>) i stilove (<em>style</em>):</p>

<textarea id="media-content" name="media-content"
    data-uk-htmleditor="{mode:'tab'}">
&lt;div
    class="uk-cover-background"
    style="height:400px;background-image:url('/media/trippy.jpg');"&gt;
&lt;/div&gt;
</textarea>

</div>
</div>
</div>
