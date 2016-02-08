<?php
session_start();
error_reporting(E_ALL);
ini_set('max_execution_time', 0);

$site_path = realpath(dirname(__FILE__));
define('__SITE_PATH', $site_path);

if(!file_exists(__SITE_PATH.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR.'config.php'))
{
    die("<b>Error</b>: <br>Config file not exist");
}

include 'includes'.DIRECTORY_SEPARATOR.'init.php';

$registry->router = new router($registry);

$registry->router->setPath(__SITE_PATH.DIRECTORY_SEPARATOR.'controller');

$registry->template = new template($registry);

$registry->router->loader();
?>