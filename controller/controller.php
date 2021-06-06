<?php

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personalInfo()
    {
        //If the form has been submitted, add the data to the session
        //and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_SESSION = array();

            $userFirst = "";
            $userLast = "";
            $userAge = "";
            $userPhone = "";
            $userGender = "";
            $userPremium = false;

            $userFirst = $_POST['fName'];
            $userLast = $_POST['lName'];
            $userAge = $_POST['age'];
            $userPhone = $_POST['number'];
            $userGender = $_POST['gender'];
            $userPremium = isset($_POST['premium']);

            if (!Validation::validName($userFirst))
            {
                $this->_f3->set('errors["fname"]', "Please input a valid first name");
            }

            if (!Validation::validName($userLast))
            {
                $this->_f3->set('errors["lname"]', "Please input a valid last name");
            }

            if (!Validation::validAge($userAge))
            {
                $this->_f3->set('errors["age"]', "Please enter a valid age");
            }

            if (!Validation::validPhone($userPhone))
            {
                $this->_f3->set('errors["number"]', "Please enter a valid phone number");
            }

            $this->_f3->set('userFirst', $userFirst);
            $this->_f3->set('userLast', $userLast);
            $this->_f3->set('userAge', $userAge);
            $this->_f3->set('userPhone', $userPhone);
            $this->_f3->set('userGender', $userGender);
            $this->_f3->set('userPremium', $userPremium);

            if (empty($this->_f3->get('errors')))
            {
                header('location: step2');
            }
        }
        //Display the personal info page
        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userEmail = "";
            $userState = "";
            $userBio = "";
            $userSeeking = "";
            $userEmail = $_POST['email'];
            $userState = $_POST['state'];
            $userBio = $_POST['bio'];
            $userSeeking = $_POST['seeking'];


            if (Validation::validEmail($userEmail))
            {
                $_SESSION['email'] = $userEmail;
            }
            else
            {
                $this->_f3->set('errors["email"]', "Please enter a valid email address");
            }

            $_SESSION['state'] = $userState;
            $_SESSION['seeking'] = $userSeeking;
            $_SESSION['bio'] = $userBio;

            $this->_f3->set('userEmail', $userEmail);
            $this->_f3->set('userState', $userState);
            $this->_f3->set('userBio', $userBio);
            $this->_f3->set('userSeeking', $userSeeking);

            if (empty($this->_f3->get('errors')))
            {
                header('location: step3');
            }
        }
        $this->_f3->set('states', DataLayer::getStates());
        //Display the profile page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
        $userIndoor = array();
        $userOutdoor = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userIndoor = $_POST['indoorInterests'];
            $userOutdoor = $_POST['outdoorInterests'];

            if (Validation::validIndoor($userIndoor))
            {
                $_SESSION['indoor'] = implode(", ", $userIndoor);
            }
            else
            {
                $this->_f3->set('errors["indoor"]', "Begone evildoer!");
            }

            if (Validation::validOutdoor($userOutdoor))
            {
                $_SESSION['outdoor'] = implode(", ", $userOutdoor);
            }
            else
            {
                $this->_f3->set('errors["outdoor"]', "Begone evildoer!");
            }
            if (empty($this->_f3->get('errors')))
            {
                header('location: summary');
            }
        }

        //Get the indoor and outdoor activities and send them to the view
        $this->_f3->set('indoor', getIndoors());
        $this->_f3->set('outdoor', getOutdoors());

        $this->_f3->set('userIndoor', $userIndoor);
        $this->_f3->set('userOutdoor', $userOutdoor);

        //Display the interests page
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {
        //Display the summary page
        $view = new Template();
        echo $view->render('views/summary.html');
    }
}