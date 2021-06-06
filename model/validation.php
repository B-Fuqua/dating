<?php

class Validation
{
    static function validName($name): bool
    {
        $pattern = "/^[a-z]+$/i";
        return preg_match($pattern, $name) == 1;
    }

    static function validAge($age): bool
    {
        $age = floatval($age);
        if (is_nan($age) != 1) {
            return ($age >= 18 && $age <= 118);
        }
        return false;
    }

    static function validPhone($phone): bool
    {
        $pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
        return preg_match($pattern, $phone) == 1;
    }

    static function validEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    static function validOutdoor($outdoor): bool
    {
        $validOutdoor = DataLayer::getOutdoors();
        if (!empty($outdoor)) {
            foreach ($outdoor as $userOutdoor) {
                if (!in_array($userOutdoor, $validOutdoor)) {
                    return false;
                }
            }
        }
        return true;
    }

    static function validIndoor($indoor): bool
    {
        $validIndoor = DataLayer::getIndoors();
        if (!empty($indoor)) {
            foreach ($indoor as $userIndoor) {
                if (!in_array($userIndoor, $validIndoor)) {
                    return false;
                }
            }
        }
        return true;
    }
}