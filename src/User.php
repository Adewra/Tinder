<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      17/02/15 11:12
 */

namespace Adewra\Tinder;


class User {

    /* Fields */
    private $_id;
    private $activeTime;
    private $createDate;
    private $ageFilterMax;
    private $ageFilterMin;
    private $apiToken;
    private $bio;
    private $birthDate;
    private $distanceFilter;
    private $fullName;
    private $groups = array();
    private $gender;
    private $genderFilter;
    private $name;
    private $pingTime;
    private $discoverable;
    private $photos = array();
    private $versions = array();
    private $globals = array();

    function __construct()
    {

    }

    function loadFromAuthenticationResponse($authenticationResponse)
    {
        var_dump($authenticationResponse);

        if(isset($authenticationResponse['_id']))
            $this->setIdentifier($authenticationResponse['_id']);

        if(isset($authenticationResponse['active_time']))
            $this->setIdentifier($authenticationResponse['active_time']);
    }

    function getIdentifier()
    {
        return $this->_id;
    }

    function setIdentifier($identifier)
    {
        $this->_id = $identifier;
    }

    function getActiveTime()
    {
        return $this->activeTime;
    }

    function setActiveTime($activeTime)
    {
        $this->activeTime = $activeTime;
    }

    function getCreateDate()
    {
        return $this->createDate;
    }

    function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }
} 