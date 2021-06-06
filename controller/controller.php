<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3;

    /**
     * Controller constructor.
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Display the home page
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Display the personal Info page
     */
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

            if ($userPremium)
            {
                $_SESSION['user'] = new PremiumMember();
            }
            else
            {
                $_SESSION['user'] = new Member();
            }

            if (Validation::validName($userFirst))
            {
                $_SESSION['user']->setFname($userFirst);
            }
            else
            {
                $this->_f3->set('errors["fname"]', "Please input a valid first name");
            }

            if (Validation::validName($userLast))
            {
                $_SESSION['user']->setLname($userLast);
            }
            else
            {
                $this->_f3->set('errors["lname"]', "Please input a valid last name");
            }

            if (Validation::validAge($userAge))
            {
                $_SESSION['user']->setAge($userAge);
            }
            else
            {
                $this->_f3->set('errors["age"]', "Please enter a valid age");
            }

            if (Validation::validPhone($userPhone))
            {
                $_SESSION['user']->setPhone($userPhone);
            }
            else
            {
                $this->_f3->set('errors["number"]', "Please enter a valid phone number");
            }

            if (!is_null($userGender))
            {
                $_SESSION['user']->setGender($userGender);
            }
            else
            {
                $this->_f3->set('errors["gender"]', "Please select the gender you identify as");
            }

            $this->_f3->set('userFirst', $userFirst);
            $this->_f3->set('userLast', $userLast);
            $this->_f3->set('userAge', $userAge);
            $this->_f3->set('userPhone', $userPhone);
            $this->_f3->set('userGender', $userGender);


            if (empty($this->_f3->get('errors')))
            {
                header('location: step2');
            }
        }
        //Display the personal info page
        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    /**
     * Display the profile page
     */
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
                $_SESSION['user']->setEmail($userEmail);
            }
            else
            {
                $this->_f3->set('errors["email"]', "Please enter a valid email address");
            }

            if (!is_null($userSeeking))
            {
                $_SESSION['user']->setSeeking($userSeeking);
            }
            else
            {
                $this->_f3->set('errors["seeking"]', "Please enter the gender you seek in a partner");
            }

            $_SESSION['user']->setState($userState);

            $_SESSION['user']->setBio($userBio);

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

    /**
     * Display the interests page (If the user is a premium member)
     */
    function interests()
    {
        if ($_SESSION['user'] instanceof PremiumMember)
        {
            $userIndoor = array();
            $userOutdoor = array();
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $userIndoor = $_POST['indoorInterests'] == null ? array() : $_POST['indoorInterests'];
                $userOutdoor = $_POST['outdoorInterests'] == null ? array() : $_POST['outdoorInterests'];

                if (Validation::validIndoor($userIndoor))
                {
                    $_SESSION['user']->setInDoorInterests($userIndoor);
                }
                else
                {
                    $this->_f3->set('errors["indoor"]', "Begone evildoer!");
                }

                if (Validation::validOutdoor($userOutdoor))
                {
                    $_SESSION['user']->setOutDoorInterests($userOutdoor);
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
            $this->_f3->set('indoor', DataLayer::getIndoors());
            $this->_f3->set('outdoor', DataLayer::getOutdoors());

            $this->_f3->set('userIndoor', $userIndoor);
            $this->_f3->set('userOutdoor', $userOutdoor);

            //Display the interests page
            $view = new Template();
            echo $view->render('views/interests.html');
        }
        else
        {
            header('location: summary');
        }
    }

    /**
     * Display the summary page
     */
    function summary()
    {
        //Display the summary page
        $view = new Template();
        echo $view->render('views/summary.html');
    }
}