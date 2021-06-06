<?php

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once ('vendor/autoload.php');

//Instantiate Fat-Free
$f3 = Base::instance();
$con = new Controller($f3);

//Start a session
session_start();

//Define routes
$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET|POST /step1', function($f3){
    $GLOBALS['con']->personalInfo();
});

$f3->route('GET|POST /step2', function($f3){
    $GLOBALS['con']->profile();
});

$f3->route('GET|POST /step3', function($f3){
    $GLOBALS['con']->interests();
});

$f3->route('GET /summary', function(){
    $GLOBALS['con']->summary();
});

//Run Fat-Free
$f3->run();