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

$f3->route('GET|POST /step1', function($f3){
    //If the form has been submitted, add the data to the session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION = array();

        $userFirst = "";
        $userLast = "";
        $userAge = "";
        $userPhone = "";
        $userGender = "";

        $userFirst = $_POST['fName'];
        $userLast = $_POST['lName'];
        $userAge = $_POST['age'];
        $userPhone = $_POST['number'];
        $userGender = $_POST['gender'];
        $_SESSION['gender'] = $userGender;

        if (validName($userFirst))
        {
            $_SESSION['fName'] = $_POST['fName'];
        }
        else
        {
            $f3->set('errors["fname"]', "Please input a valid first name");
        }

        if (validName($userLast))
        {
            $_SESSION['lName'] = $_POST['lName'];
        }
        else
        {
            $f3->set('errors["lname"]', "Please input a valid last name");
        }

        if (validAge($userAge))
        {
            $_SESSION['age'] = $_POST['age'];
        }
        else
        {
            $f3->set('errors["age"]', "Please enter a valid age");
        }

        if (validPhone($userPhone))
        {
            $_SESSION['number'] = $_POST['number'];
        }
        else
        {
            $f3->set('errors["number"]', "Please enter a valid phone number");
        }

        $f3->set('userFirst', $userFirst);
        $f3->set('userLast', $userLast);
        $f3->set('userAge', $userAge);
        $f3->set('userPhone', $userPhone);
        $f3->set('userGender', $userGender);

        if (empty($f3->get('errors')))
        {
            header('location: step2');
        }
    }
    //Display the personal info page
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$f3->route('GET|POST /step2', function($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userEmail = "";
        $userState = "";
        $userBio = "";
        $userSeeking = "";
        $userEmail = $_POST['email'];
        $userState = $_POST['state'];
        $userBio = $_POST['bio'];
        $userSeeking = $_POST['seeking'];


        if (validEmail($userEmail))
        {
            $_SESSION['email'] = $userEmail;
        }
        else
        {
            $f3->set('errors["email"]', "Please enter a valid email address");
        }

        $_SESSION['state'] = $userState;
        $_SESSION['seeking'] = $userSeeking;
        $_SESSION['bio'] = $userBio;

        $f3->set('userEmail', $userEmail);
        $f3->set('userState', $userState);
        $f3->set('userBio', $userBio);
        $f3->set('userSeeking', $userSeeking);

        if (empty($f3->get('errors')))
        {
            header('location: step3');
        }
    }
    $f3->set('states', getStates());
    //Display the profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /step3', function($f3){
    $userIndoor = array();
    $userOutdoor = array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userIndoor = $_POST['indoorInterests'];
        $userOutdoor = $_POST['outdoorInterests'];

        if (validIndoor($userIndoor))
        {
            $_SESSION['indoor'] = implode(", ", $userIndoor);
        }
        else
        {
            $f3->set('errors["indoor"]', "Begone evildoer!");
        }

        if (validOutdoor($userOutdoor))
        {
            $_SESSION['outdoor'] = implode(", ", $userOutdoor);
        }
        else
        {
            $f3->set('errors["outdoor"]', "Begone evildoer!");
        }
        if (empty($f3->get('errors')))
        {
            header('location: summary');
        }
    }

    //Get the indoor and outdoor activities and send them to the view
    $f3->set('indoor', getIndoors());
    $f3->set('outdoor', getOutdoors());

    $f3->set('userIndoor', $userIndoor);
    $f3->set('userOutdoor', $userOutdoor);

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