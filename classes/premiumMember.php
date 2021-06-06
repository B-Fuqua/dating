<?php

/**
 * Class PremiumMember
 * Represents a premium member of the dating site
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor.
     * @param string $fname first name
     * @param string $lname last name
     * @param int $age age
     * @param string $gender gender
     * @param string $phone phone number
     * @param string $email email address
     * @param string $state state
     * @param string $seeking seeking
     * @param string $bio biography
     * @param array $_inDoorInterests indoor interests
     * @param array $_outDoorInterests outdoor interests
     */
    public function __construct($fname="", $lname="", $age=0, $gender="", $phone="",
                                $email="", $state="", $seeking="", $bio="",
                                $_inDoorInterests=array(), $_outDoorInterests=array())
    {
        parent::__construct($fname, $lname, $age, $gender,
            $phone, $email, $state, $seeking, $bio);
        $this->_inDoorInterests = $_inDoorInterests;
        $this->_outDoorInterests = $_outDoorInterests;
    }

    /**
     * @return array User's indoor interests
     */
    public function getInDoorInterests(): array
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param array $inDoorInterests User's indoor interests
     */
    public function setInDoorInterests(array $inDoorInterests): void
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return array User's outdoor interests
     */
    public function getOutDoorInterests(): array
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param array $outDoorInterests User's outdoor interests
     */
    public function setOutDoorInterests(array $outDoorInterests): void
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}