<?php

// Debug

define( "DEBUG_MODE", true );

// Database

define( "DB_NAME", "Netpune" );
define( "DB_HOST", "localhost" );
define( "DB_USR", "root" );
define( "DB_PWD", "valkyria" );

// Email

define( "SMTP_HOST", "smtp.gmail.com" );
define( "SMTP_NAME", "Neptune" );
define( "SMTP_USER", "contact.neptune.epsi@gmail.com" );
define( "SMTP_PASSWORD", "valkyria" );
define( "SMTP_PORT", 465 );

// PATH

define( "CORE", ROOT. "/core" );
define( "CONTROLLERS", ROOT. '/controllers' );
define( "MAILS", ROOT. '/mails' );
define( "MODELS", ROOT. '/models' );
define( "PLUGINS", ROOT. '/plugins' );
define( "VIEWS", ROOT. '/views' );

// Router

define( "CONTROLLER_DEF", "home" );
define( "ACTION_DEF", "index" );

// DATE

define( "YEAR", date( "Y" ) );

?>