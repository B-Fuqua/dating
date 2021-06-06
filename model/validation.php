<?php

/**
 * Class Validation
 */
class Validation
{
    /**
     * @param $name
     * @return bool
     */
    static function validName($name): bool
    {
        $pattern = "/^[a-z]+$/i";
        return preg_match($pattern, $name) == 1;
    }

    /**
     * @param $age
     * @return bool
     */
    static function validAge($age): bool
    {
        $age = floatval($age);
        if (is_nan($age) != 1) {
            return ($age >= 18 && $age <= 118);
        }
        return false;
    }

    /**
     * @param $phone
     * @return bool
     */
    static function validPhone($phone): bool
    {
        $pattern = '/^\s*(?:\+?(\d{1,3}))?([-. (]*(\d{3})[-. )]*)?((\d{3})[-. ]*(\d{2,4})(?:[-.x ]*(\d+))?)\s*$/';
        return preg_match($pattern, $phone) == 1;
    }

    /**
     * @param $email
     * @return bool
     */
    static function validEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $outdoor
     * @return bool
     */
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

    /**
     * @param $indoor
     * @return bool
     */
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