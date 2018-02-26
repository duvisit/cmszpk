
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Sustav" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Sustav.html">Sustav</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Sustav_Model" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Sustav/Model.html">Model</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Sustav_Model_Facebook" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Model/Facebook.html">Facebook</a>                    </div>                </li>                            <li data-name="class:Sustav_Model_Model" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Model/Model.html">Model</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Sustav_Pogled" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Sustav/Pogled.html">Pogled</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Sustav_Pogled_Pogled" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Pogled/Pogled.html">Pogled</a>                    </div>                </li>                            <li data-name="class:Sustav_Pogled_Sadrzaj" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Pogled/Sadrzaj.html">Sadrzaj</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Sustav_Upravljac" >                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Sustav/Upravljac.html">Upravljac</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Sustav_Upravljac_Sesija" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Upravljac/Sesija.html">Sesija</a>                    </div>                </li>                            <li data-name="class:Sustav_Upravljac_Upravljac" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Upravljac/Upravljac.html">Upravljac</a>                    </div>                </li>                            <li data-name="class:Sustav_Upravljac_Zahtjev" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Sustav/Upravljac/Zahtjev.html">Zahtjev</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Sustav_HTTPStatus" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Sustav/HTTPStatus.html">HTTPStatus</a>                    </div>                </li>                            <li data-name="class:Sustav_Postavke" >                    <div style="padding-left:26px" class="hd leaf">                        <a href="Sustav/Postavke.html">Postavke</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Sustav.html", "name": "Sustav", "doc": "Namespace Sustav"},{"type": "Namespace", "link": "Sustav/Model.html", "name": "Sustav\\Model", "doc": "Namespace Sustav\\Model"},{"type": "Namespace", "link": "Sustav/Pogled.html", "name": "Sustav\\Pogled", "doc": "Namespace Sustav\\Pogled"},{"type": "Namespace", "link": "Sustav/Upravljac.html", "name": "Sustav\\Upravljac", "doc": "Namespace Sustav\\Upravljac"},
            
            {"type": "Class", "fromName": "Sustav", "fromLink": "Sustav.html", "link": "Sustav/HTTPStatus.html", "name": "Sustav\\HTTPStatus", "doc": "&quot;HTTP status.&quot;"},
                    
            {"type": "Class", "fromName": "Sustav\\Model", "fromLink": "Sustav/Model.html", "link": "Sustav/Model/Facebook.html", "name": "Sustav\\Model\\Facebook", "doc": "&quot;Facebook Graph API.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Model\\Facebook", "fromLink": "Sustav/Model/Facebook.html", "link": "Sustav/Model/Facebook.html#method_feed", "name": "Sustav\\Model\\Facebook::feed", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav\\Model", "fromLink": "Sustav/Model.html", "link": "Sustav/Model/Model.html", "name": "Sustav\\Model\\Model", "doc": "&quot;Model sadr\u017eaja.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_dbConnect", "name": "Sustav\\Model\\Model::dbConnect", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_sqlFetch", "name": "Sustav\\Model\\Model::sqlFetch", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_sqlFetchAll", "name": "Sustav\\Model\\Model::sqlFetchAll", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_sqlFetchColumn", "name": "Sustav\\Model\\Model::sqlFetchColumn", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_sqlFetchSingle", "name": "Sustav\\Model\\Model::sqlFetchSingle", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_getLangnav", "name": "Sustav\\Model\\Model::getLangnav", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_getSourceTitle", "name": "Sustav\\Model\\Model::getSourceTitle", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_deleteRecord", "name": "Sustav\\Model\\Model::deleteRecord", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_saveUpload", "name": "Sustav\\Model\\Model::saveUpload", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Model\\Model", "fromLink": "Sustav/Model/Model.html", "link": "Sustav/Model/Model.html#method_saveRecord", "name": "Sustav\\Model\\Model::saveRecord", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav\\Pogled", "fromLink": "Sustav/Pogled.html", "link": "Sustav/Pogled/Pogled.html", "name": "Sustav\\Pogled\\Pogled", "doc": "&quot;Pogled na sadr\u017eaj.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Pogled\\Pogled", "fromLink": "Sustav/Pogled/Pogled.html", "link": "Sustav/Pogled/Pogled.html#method___construct", "name": "Sustav\\Pogled\\Pogled::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Pogled", "fromLink": "Sustav/Pogled/Pogled.html", "link": "Sustav/Pogled/Pogled.html#method_posalji", "name": "Sustav\\Pogled\\Pogled::posalji", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav\\Pogled", "fromLink": "Sustav/Pogled.html", "link": "Sustav/Pogled/Sadrzaj.html", "name": "Sustav\\Pogled\\Sadrzaj", "doc": "&quot;Odgovor modela na upit.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method___construct", "name": "Sustav\\Pogled\\Sadrzaj::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_pogledaj", "name": "Sustav\\Pogled\\Sadrzaj::pogledaj", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderHelp", "name": "Sustav\\Pogled\\Sadrzaj::renderHelp", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderTemplate", "name": "Sustav\\Pogled\\Sadrzaj::renderTemplate", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderBlogList", "name": "Sustav\\Pogled\\Sadrzaj::renderBlogList", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderArticleList", "name": "Sustav\\Pogled\\Sadrzaj::renderArticleList", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderLogin", "name": "Sustav\\Pogled\\Sadrzaj::renderLogin", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderLogout", "name": "Sustav\\Pogled\\Sadrzaj::renderLogout", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderAdmin", "name": "Sustav\\Pogled\\Sadrzaj::renderAdmin", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderEdit", "name": "Sustav\\Pogled\\Sadrzaj::renderEdit", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderCreate", "name": "Sustav\\Pogled\\Sadrzaj::renderCreate", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderUpload", "name": "Sustav\\Pogled\\Sadrzaj::renderUpload", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderCleanup", "name": "Sustav\\Pogled\\Sadrzaj::renderCleanup", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Pogled\\Sadrzaj", "fromLink": "Sustav/Pogled/Sadrzaj.html", "link": "Sustav/Pogled/Sadrzaj.html#method_renderSqlite", "name": "Sustav\\Pogled\\Sadrzaj::renderSqlite", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav", "fromLink": "Sustav.html", "link": "Sustav/Postavke.html", "name": "Sustav\\Postavke", "doc": "&quot;Postavke sustava.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method___construct", "name": "Sustav\\Postavke::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_htmldir", "name": "Sustav\\Postavke::htmldir", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_tables", "name": "Sustav\\Postavke::tables", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_templates", "name": "Sustav\\Postavke::templates", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_mediadirs", "name": "Sustav\\Postavke::mediadirs", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_uploaddir", "name": "Sustav\\Postavke::uploaddir", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_url", "name": "Sustav\\Postavke::url", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_lang", "name": "Sustav\\Postavke::lang", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_database", "name": "Sustav\\Postavke::database", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_development", "name": "Sustav\\Postavke::development", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_timezone", "name": "Sustav\\Postavke::timezone", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_purifyhtml", "name": "Sustav\\Postavke::purifyhtml", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_facebookID", "name": "Sustav\\Postavke::facebookID", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_facebookToken", "name": "Sustav\\Postavke::facebookToken", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_facebookUrl", "name": "Sustav\\Postavke::facebookUrl", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_googleMapToken", "name": "Sustav\\Postavke::googleMapToken", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Postavke", "fromLink": "Sustav/Postavke.html", "link": "Sustav/Postavke.html#method_googleMapLatLng", "name": "Sustav\\Postavke::googleMapLatLng", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav\\Upravljac", "fromLink": "Sustav/Upravljac.html", "link": "Sustav/Upravljac/Sesija.html", "name": "Sustav\\Upravljac\\Sesija", "doc": "&quot;Sesija korisnika sustava.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Upravljac\\Sesija", "fromLink": "Sustav/Upravljac/Sesija.html", "link": "Sustav/Upravljac/Sesija.html#method_sessionToken", "name": "Sustav\\Upravljac\\Sesija::sessionToken", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Upravljac\\Sesija", "fromLink": "Sustav/Upravljac/Sesija.html", "link": "Sustav/Upravljac/Sesija.html#method_getUser", "name": "Sustav\\Upravljac\\Sesija::getUser", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Upravljac\\Sesija", "fromLink": "Sustav/Upravljac/Sesija.html", "link": "Sustav/Upravljac/Sesija.html#method_isAdmin", "name": "Sustav\\Upravljac\\Sesija::isAdmin", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Upravljac\\Sesija", "fromLink": "Sustav/Upravljac/Sesija.html", "link": "Sustav/Upravljac/Sesija.html#method_isPassword", "name": "Sustav\\Upravljac\\Sesija::isPassword", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav\\Upravljac", "fromLink": "Sustav/Upravljac.html", "link": "Sustav/Upravljac/Upravljac.html", "name": "Sustav\\Upravljac\\Upravljac", "doc": "&quot;Upravlja\u010d sadr\u017eaja.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Upravljac\\Upravljac", "fromLink": "Sustav/Upravljac/Upravljac.html", "link": "Sustav/Upravljac/Upravljac.html#method___construct", "name": "Sustav\\Upravljac\\Upravljac::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Upravljac\\Upravljac", "fromLink": "Sustav/Upravljac/Upravljac.html", "link": "Sustav/Upravljac/Upravljac.html#method_pokreni", "name": "Sustav\\Upravljac\\Upravljac::pokreni", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Upravljac\\Upravljac", "fromLink": "Sustav/Upravljac/Upravljac.html", "link": "Sustav/Upravljac/Upravljac.html#method_route", "name": "Sustav\\Upravljac\\Upravljac::route", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Sustav\\Upravljac", "fromLink": "Sustav/Upravljac.html", "link": "Sustav/Upravljac/Zahtjev.html", "name": "Sustav\\Upravljac\\Zahtjev", "doc": "&quot;HTTP zahtjev.&quot;"},
                                                        {"type": "Method", "fromName": "Sustav\\Upravljac\\Zahtjev", "fromLink": "Sustav/Upravljac/Zahtjev.html", "link": "Sustav/Upravljac/Zahtjev.html#method_httphost", "name": "Sustav\\Upravljac\\Zahtjev::httphost", "doc": "&quot;Vra\u0107a adresu web mjesta.&quot;"},
                    {"type": "Method", "fromName": "Sustav\\Upravljac\\Zahtjev", "fromLink": "Sustav/Upravljac/Zahtjev.html", "link": "Sustav/Upravljac/Zahtjev.html#method_uri", "name": "Sustav\\Upravljac\\Zahtjev::uri", "doc": "&quot;Vra\u0107a http upit.&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


