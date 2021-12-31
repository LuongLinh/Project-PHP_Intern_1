<?php
use Dotenv\Dotenv;
require_once "../mvc/Bridge.php";
require_once "../helper/Helper.php";
require "../vendor/autoload.php";

$dotenv = Dotenv::createImmutable("../");
$dotenv->load();

$app = new App();
