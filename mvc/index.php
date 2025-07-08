<?php
// code pour afficher les erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo('<pre>');
// print_r($data);
// echo('</pre>');
// die();
session_start();
require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes/web.php';
