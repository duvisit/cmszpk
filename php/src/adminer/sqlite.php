<?php
function adminer_object() {
    // required to run any plugin
    include_once __DIR__.'/plugin.php';

    // autoloader
    include_once __DIR__.'/loginSqlite.php';

    $login = 'cmszpk';
    $hash = password_hash('sqlite', PASSWORD_DEFAULT);

    $plugins = array(
        // specify enabled plugins here
        new AdminerLoginSqlite($login, $hash)
    );

    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include __DIR__.'/adminer.php';
