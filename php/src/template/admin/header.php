<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echoOutput( "Admin $table" ); ?></title>
<link rel="icon" href="/admin.ico">
<link rel="stylesheet" href="/vendor/uikit/dist/css/uikit.css">
<link rel="stylesheet" href="/vendor/uikit/vendor/highlight/highlight.css">
<script src="/vendor/js/jquery.js"></script>
<script src="/vendor/uikit/dist/js/uikit.min.js"></script>
<script src="/vendor/uikit/vendor/highlight/highlight.js"></script>
<link rel="stylesheet" href="/vendor/uikit/vendor/codemirror/codemirror.css">
<link rel="stylesheet" href="/vendor/uikit/vendor/codemirror/show-hint.css">
<script src="/vendor/uikit/vendor/codemirror/codemirror.js"></script>
<link rel="stylesheet" href="/vendor/uikit/dist/css/components/htmleditor.css">
<script src="/vendor/uikit/dist/js/components/htmleditor.js"></script>
<!-- Change featured image -->
<script language="javascript" type="text/javascript">
function changeImage () {
    var e = document.getElementById("mediasel");
    var uri = e.options[e.selectedIndex].value;
    if (uri == '') {
        uri = '/media/placeholder.svg';
    }
    var img = document.getElementById("mediaimg");
    img.src = uri;
}
</script>
</head>
<body>

<!-- header -->
<div class="uk-block uk-contrast uk-hidden-small">
<div class="uk-container uk-container-center">
<div class="uk-grid">

<div class="uk-width-1-2">
<div class="uk-panel">
<h1><?php echoOutput( $table ); ?></h1>
</div>
</div>

<div class="uk-width-1-2">
<div class="uk-panel">
<p class="uk-text-right">
<?php echoOutput( $username ); ?><br>
<a class="uk-link" href="/admin/logout">logout</a>
</p>
</div>
</div>

</div>
<?php
if (isset( $alertmsg )) {
    echo '<div class="uk-alert" data-uk-alert>'
        . '<a href="" class="uk-alert-close uk-close"></a>'
        . '<p>' . escapeOutput( $alertmsg ) . '</p>'
        . '</div>' . "\n";
} ?>
</div>
</div>

<!-- menu -->
<?php
$menulist = '';
foreach ( $menu as $item ) {
    if ( $item['title'] === $table ) {
        $menulist .= '<li class="uk-active"><a class="" href="'
            . escapeOutput( $item['slug'] ) . '">'
            . escapeOutput( $item['title'] )
            . '</a></li>' . "\n";
    } else {
        $menulist .= '<li class=""><a class="" href="'
            . escapeOutput( $item['slug'] ) . '">'
            . escapeOutput( $item['title'] )
            . '</a></li>' . "\n";
    }
} ?>
<nav class="uk-navbar">
<div class="uk-container uk-container-center">

<ul class="uk-navbar-nav uk-hidden-small">
<?= $menulist ?>
</ul>
<ul class="uk-navbar-nav uk-hidden-small uk-navbar-flip">
<li><a href="/admin/log">Log</a></li>
<li><a href="/admin/sqlite?login">Adminer</a></li>
<li><a href="/admin/help">Help</a></li>
</ul>
<a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""
    href="#offcanvas"></a>
<div class="uk-navbar-content uk-navbar-center uk-visible-small">
<span class="uk-h2"><?php echoOutput( $table ) ?></span>
</div>

</div>
</nav>

