<?php

//Require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];
        header('location: step3');
    }

    //Display the profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /step3', function($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['interests'] = implode(", ", $_POST['interests']);
        header('location: summary');
    }

    //Get the indoor and outdoor activities and send them to the view
    $f3->set('indoor', getIndoors());
    $f3->set('outdoor', getOutdoors());


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