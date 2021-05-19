<?php

include_once ('vendor/autoload.php');
include_once ('config.php');

R::setup( 'mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASSWORD, true);
if ( !R::testConnection() ) {
    echo "DB Not Connect !";
    exit();
}

Route::start();

R::close();