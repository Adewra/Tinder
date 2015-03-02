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


use Adewra\Tinder\Moment\Moment;

class Person {

    private $_id;
    private $bio;
    private $birthDate;
    protected $gender;
    private $name;
    private $pingTime;
    private $photos = array();
    private $moments = array();

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($response['_id']))
            $this->setIdentifier($response['_id']);

        if(isset($response['bio']))
            $this->setBio($response['bio']);

        if(isset($response['birth_date']))
            $this->setBirthDate($response['birth_date']);

        if(isset($response['gender']))
            $this->setGender($response['gender']);

        if(isset($response['name']))
            $this->setName($response['name']);

        if(isset($response['ping_time']))
            $this->setPingTime($response['ping_time']);

        if(isset($response['photos']))
            $this->setPhotos($response['photos']);
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

    private function addPhoto(Photo $photo)
    {
        array_push($this->photos, $photo);
    }

    public function getMoments()
    {
        return $this->moments;
    }

    public function setMoments($moments)
    {
        foreach($moments as $moment)
        {
            $momentObject = new Moment();
            $momentObject->loadFromResponse($moment);
            $this->addMoment($momentObject);
        }
    }

    private function addMoment(Moment $moment)
    {
        array_push($this->moments, $moment);
    }

}