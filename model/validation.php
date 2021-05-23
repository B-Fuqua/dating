<?php

function validName($name)
{
    $pattern = "/^[a-z]+$/i";
    return preg_match($pattern, $name) == 1;
}

function validAge($age)
{
    $age = floatval($age);
    if (is_nan($age) != 1)
    {
        return ($age >= 18 && $age <= 118);
    }
    return false;
}

function validPhone($phone)
{
    $pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
    return preg_match($pattern, $phone) == 1;
}

function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validOutdoor($outdoor)
{
    $validOutdoor = getOutdoors();
    if (!empty($outdoor))
    {
        foreach ($outdoor as $userOutdoor)
        {
            if (!in_array($userOutdoor, $validOutdoor))
            {
                return false;
            }
        }
    }
    return true;
}

function validIndoor($indoor)
{
    $validIndoor = getIndoors();
    if (!empty($indoor))
    {
        foreach ($indoor as $userIndoor)
        {
            if (!in_array($userIndoor, $validIndoor))
            {
                return false;
            }
        }
    }
    return true;
}