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

$f3->route('GET|POST /step1', function(){
    //Display the personal info page
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$f3->route('GET|POST /step2', function(){
    //Display the profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /step3', function(){
    //Display the interests page
    $view = new Template();
    echo $view->render('views/interests.html');
});

$f3->route('GET /summary', function(){
    //Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();