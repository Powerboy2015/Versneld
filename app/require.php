<?php
require_once realpath('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

require_once 'lib/controller.php';
require_once 'lib/core.php';
require_once 'config/config.php';
require_once 'lib/Database.php';
require_once 'phpmailer/Mail.php';



$init = new Core();
