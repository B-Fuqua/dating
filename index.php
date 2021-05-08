<!--
   Ben Fuqua
   4/24/21
   index.php
   Launch page for the dating site
-->

<?php
//This is my controller for the dating site

//Require autoload file
require_once ('vendor/autoload.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Define routes
$f3->route('GET /', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /firstStep', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$f3->route('GET|POST /nextStep', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /lastStep', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/interests.html');
});

$f3->route('GET /summary', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();