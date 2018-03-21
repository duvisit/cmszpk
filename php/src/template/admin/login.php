<!DOCTYPE html>
<html class="uk-height-1-1">
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Login page">
<meta name="keywords" content="login, page">
<title>Login</title>
<link rel="stylesheet" href="/vendor/uikit/dist/css/uikit.css">
<script src="/vendor/js/jquery.js"></script>
<script src="/vendor/uikit/dist/js/uikit.min.js"></script>
</head>

<body class="uk-height-1-1">

<div class="uk-vertical-align uk-text-center uk-height-1-1">
<div class="uk-vertical-align-middle" style="width: 250px;">

<div class="uk-margin-bottom">
<h1><a style="" href="/">Homepage</a></h1>
<?php if ( isset( $alertmsg )) : ?>
<div class="uk-alert">
<p><?= $alertmsg ?></p>
</div>
<?php endif ?>
</div>

<form class="uk-panel uk-panel-box uk-form"
    action="/admin/login" method="post">

<input type="hidden" name="csrf" value="<?= $csrf ?>">

<div class="uk-form-row">
<input class="uk-width-1-1 uk-form-large"
    type="text" name="username" placeholder="Username" required autofocus>
</div>

<div class="uk-form-row">
<input class="uk-width-1-1 uk-form-large"
    type="password" name="password" placeholder="Password" required>
</div>

<div class="uk-form-row">
<input class="uk-width-1-1 uk-button uk-button-primary uk-button-large uk-text-contrast"
    type="submit" name="login" value="Login">
</div>

</form>

</div>
</div>

</body>

</html>
