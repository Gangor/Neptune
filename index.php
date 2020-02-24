<?php

    define('WEBROOT', str_replace( 'index.php', "", $_SERVER[ "SCRIPT_NAME" ] ) );
    define('ROOT', str_replace( 'index.php', "", $_SERVER[ "SCRIPT_FILENAME" ] ) );

    require( ROOT. "config.php" );
    require( ROOT. "core/dispatcher.php" );
    require( ROOT. "core/form.php" );
    require( ROOT. "core/router.php" );
    require( ROOT. "core/request.php" );
    require( ROOT. "core/session.php" );

    $session = new Session();
    $dispatcher = new Dispatcher();

    $dispatcher->dispatch();

?>