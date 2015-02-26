<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 10:06
 */

namespace Adewra\Tinder;


class Person {

    private $_id;
    private $bio;
    private $birthDate;
    protected $gender;
    private $name;
    private $pingTime;
    private $photos = array();

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['_id']))
            $this->setIdentifier($authenticationResponse['_id']);

        if(isset($authenticationResponse['bio']))
            $this->setBio($authenticationResponse['bio']);

        if(isset($authenticationResponse['birth_date']))
            $this->setBirthDate($authenticationResponse['birth_date']);

        if(isset($authenticationResponse['gender']))
            $this->setGender($authenticationResponse['gender']);

        if(isset($authenticationResponse['name']))
            $this->setName($authenticationResponse['name']);

        if(isset($authenticationResponse['ping_time']))
            $this->setPingTime($authenticationResponse['ping_time']);

        if(isset($authenticationResponse['photos']))
            $this->setPhotos($authenticationResponse['photos']);
    }

    public function getIdentifier()
    {
        return $this->_id;
    }

    protected function setIdentifier($identifier)
    {
        $this->_id = $identifier;
    }

    public function getBio()
    {
        return $this->bio;
    }

    protected function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    protected function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getGender()
    {
        return $this->gender;
    }

    protected function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    function getPingTime()
    {
        return $this->pingTime;
    }

    protected function setPingTime($pingTime)
    {
        $this->pingTime = $pingTime;
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    protected function setPhotos($photos)
    {
        foreach($photos as $photo)
        {
            $photoObject = new Photo();
            $photoObject->loadFromAuthenticationResponse($photo);
            $this->addPhoto($photoObject);
        }
    }

    private function addPhoto($photo)
    {
        array_push($this->photos, $photo);
    }

}