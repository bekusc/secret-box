<?php namespace core;

session_start();

$config = require('../config/config.php');
require('../vendor/autoload.php');
require('sanitize.php');

$view = new View(BASEPATH.'/app/views/');
$router = new Router();
