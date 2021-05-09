<?php

//Require autoload file
require_once ('vendor/autoload.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Start a session
session_start();

//Define routes
$f3->route('GET /', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /step1', function(){
    //If the form has been submitted, add the data to the session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['number'] = $_POST['number'];
        header('location: step2');
    }

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