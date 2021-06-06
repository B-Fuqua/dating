<?php

/**
 * Class Member
 * Represents a non-premium member of the dating site
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param string $fname first name
     * @param string $lname last name
     * @param int    $age age
     * @param string $gender gender
     * @param string $phone phone number
     * @param string $email email address
     * @param string $state state
     * @param string $seeking seeking
     * @param string $bio biography
     */
    public function __construct($fname="", $lname="", $age=0, $gender="", $phone="",
                                $email="", $state="", $seeking="", $bio="")
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_state = $state;
        $this->_seeking = $seeking;
        $this->_bio = $bio;
    }

    /**
     * @return string
     * Get the user first name
     */
    public function getFname(): string
    {
        return $this->_fname;
    }

    /**
     * @param string $fname
     * Set the user first name
     */
    public function setFname(string $fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * @return string
     * Get the user last name
     */
    public function getLname(): string
    {
        return $this->_lname;
    }

    /**
     * @param string $lname
     * Set the user last name
     */
    public function setLname(string $lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * @return int
     * Get the user age
     */
    public function getAge(): int
    {
        return $this->_age;
    }

    /**
     * @param int $age
     * Set the user age
     */
    public function setAge(int $age): void
    {
        $this->_age = $age;
    }

    /**
     * @return string
     * Get the user gender
     */
    public function getGender(): string
    {
        return $this->_gender;
    }

    /**
     * @param string $gender
     * Set the user gender
     */
    public function setGender(string $gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return string
     * Get the user phone number
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }

    /**
     * @param string $phone
     * Set the user phone number
     */
    public function setPhone(string $phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @return string
     * Get the user email
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param string $email
     * Set the user email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }

    /**
     * @return string
     * Get the user state
     */
    public function getState(): string
    {
        return $this->_state;
    }

    /**
     * @param string $state
     * Set the user state
     */
    public function setState(string $state): void
    {
        $this->_state = $state;
    }

    /**
     * @return string
     * Get the user seeking gender
     */
    public function getSeeking(): string
    {
        return $this->_seeking;
    }

    /**
     * @param string $seeking
     * Set the user seeking gender
     */
    public function setSeeking(string $seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return string
     * Get the user Bio
     */
    public function getBio(): string
    {
        return $this->_bio;
    }

    /**
     * @param string $bio
     * Set the user bio
     */
    public function setBio(string $bio): void
    {
        $this->_bio = $bio;
    }
}
