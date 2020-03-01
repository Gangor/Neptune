<?php

    define('WEBROOT', str_replace( 'index.php', "", $_SERVER[ "SCRIPT_NAME" ] ) );
    define('ROOT', str_replace( 'index.php', "", $_SERVER[ "SCRIPT_FILENAME" ] ) );

    require( ROOT. "config.php" );
    require( CORE. "/dispatcher.php" );
    require( CORE. "/form.php" );
    require( CORE. "/router.php" );
    require( CORE. "/request.php" );
    require( CORE. "/session.php" );

    $session = new Session();
    $dispatcher = new Dispatcher();

    $dispatcher->dispatch();

?>