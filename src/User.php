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

use GuzzleHttp\Client;

class User {

    /* Fields */
    private $guzzleClient;
    private $messages = array();

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
    private $purchases = array();

    function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function loadFromAuthenticationResponse($authenticationResponse)
    {
        if(isset($authenticationResponse['_id']))
            $this->setIdentifier($authenticationResponse['_id']);

        if(isset($authenticationResponse['active_time']))
            $this->setActiveTime($authenticationResponse['active_time']);

        if(isset($authenticationResponse['create_date']))
            $this->setCreateDate($authenticationResponse['create_date']);

        if(isset($authenticationResponse['age_filter_max']))
            $this->setAgeFilterMaximum($authenticationResponse['age_filter_max']);

        if(isset($authenticationResponse['age_filter_min']))
            $this->setAgeFilterMinimum($authenticationResponse['age_filter_min']);

        if(isset($authenticationResponse['api_token']))
            $this->setAPIToken($authenticationResponse['api_token']);

        if(isset($authenticationResponse['bio']))
            $this->setBio($authenticationResponse['bio']);

        if(isset($authenticationResponse['birth_date']))
            $this->setBirthDate($authenticationResponse['birth_date']);

        if(isset($authenticationResponse['distance_filter']))
            $this->setDistanceFilter($authenticationResponse['distance_filter']);

        if(isset($authenticationResponse['full_name']))
            $this->setFullName($authenticationResponse['full_name']);

        if(isset($authenticationResponse['groups']))
            $this->setGroups($authenticationResponse['groups']);

        if(isset($authenticationResponse['gender']))
            $this->setGender($authenticationResponse['gender']);

        if(isset($authenticationResponse['gender_filter']))
            $this->setGenderFilter($authenticationResponse['gender_filter']);

        if(isset($authenticationResponse['name']))
            $this->setName($authenticationResponse['name']);

        if(isset($authenticationResponse['ping_time']))
            $this->setPingTime($authenticationResponse['ping_time']);

        if(isset($authenticationResponse['discoverable']))
            $this->setDiscoverable($authenticationResponse['discoverable']);

        if(isset($authenticationResponse['photos']))
            $this->setPhotos($authenticationResponse['photos']);

        if(isset($authenticationResponse['purchases']))
            $this->setPurchases($authenticationResponse['purchases']);

        if(isset($authenticationResponse['versions']))
            $this->setVersions($authenticationResponse['versions']);
    }

    public function fetchUpdates()
    {
        $guzzleResponse = $this->guzzleClient->get('/updates', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");
        }
    }

    public function updateLocation($latitude, $longitude)
    {
        $payload = json_encode(
            array(
                "lat" => $latitude,
                "lon" => $longitude
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/user/ping', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");
        }
    }

    private function updateProfile()
    {
        $payload = json_encode(
            array(
                "discoverable" => $this->getDiscoverable(),
                "gender" => $this->getGender(),
                "age_filter_min" => $this->getAgeFilterMinimum(),
                "age_filter_max" => $this->getAgeFilterMaximum(),
                "distance_filter" => $this->getDistanceFilter()
            )
        );
        $guzzleResponse = $this->guzzleClient->post('/profile', ['body' => $payload, 'debug' => true]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");
        }
    }

    public function getIdentifier()
    {
        return $this->_id;
    }

    private function setIdentifier($identifier)
    {
        $this->_id = $identifier;
    }

    public function getActiveTime()
    {
        return $this->activeTime;
    }

    private function setActiveTime($activeTime)
    {
        $this->activeTime = $activeTime;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    private function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    public function getAgeFilterMaximum()
    {
        return $this->ageFilterMax;
    }

    private function setAgeFilterMaximum($ageFilterMaximum)
    {
        $this->ageFilterMax = $ageFilterMaximum;
    }

    public function updateAgeFilterMaximum($ageFilterMaximum)
    {
        $this->ageFilterMax = $ageFilterMaximum;
        $this->updateProfile();
    }

    public function getAgeFilterMinimum()
    {
        return $this->ageFilterMin;
    }

    private function setAgeFilterMinimum($ageFilterMinimum)
    {
        $this->ageFilterMin = $ageFilterMinimum;
    }

    public function updateAgeFilterMinimum($ageFilterMinimum)
    {
        $this->ageFilterMin = $ageFilterMinimum;
        $this->updateProfile();
    }

    public function getAPIToken()
    {
        return $this->apiToken;
    }

    private function setAPIToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function getBio()
    {
        return $this->bio;
    }

    private function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    private function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getDistanceFilter()
    {
        return $this->distanceFilter;
    }

    private function setDistanceFilter($distanceFilter)
    {
        $this->distanceFilter = $distanceFilter;
    }

    public function updateDistanceFilter($distanceFilter)
    {
        $this->distanceFilter = $distanceFilter;
        $this->updateProfile();
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    private function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    private function setGroups($groups)
    {
        foreach($groups as $group)
        {
            $this->addGroup($group);
        }
    }

    private function addGroup($group)
    {
        array_push($this->groups, $group);
    }

    public function getGender()
    {
        return $this->gender;
    }

    private function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function updateGender($gender)
    {
        $this->gender = $gender;
        $this->updateProfile();
    }

    function getGenderFilter()
    {
        return $this->genderFilter;
    }

    private function setGenderFilter($genderFilter)
    {
        $this->genderFilter = $genderFilter;
    }

    public function getName()
    {
        return $this->name;
    }

    private function setName($name)
    {
        $this->name = $name;
    }

    function getPingTime()
    {
        return $this->pingTime;
    }

    private function setPingTime($pingTime)
    {
        $this->pingTime = $pingTime;
    }

    public function getDiscoverable()
    {
        return $this->discoverable;
    }

    private function setDiscoverable($discoverable)
    {
        $this->discoverable = $discoverable;
    }

    public function updateDiscoverable($discoverable)
    {
        $this->discoverable = $discoverable;
        $this->updateProfile();
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    private function setPhotos($photos)
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

    public function getPurchases()
    {
        return $this->purchases;
    }

    private function setPurchases($purchases)
    {
        foreach($purchases as $purchase)
        {
            $this->addPurchase($purchase);
        }
    }

    private function addPurchase($purchase)
    {
        array_push($this->purchases, $purchase);
    }

    public function getVersions()
    {
        return $this->versions;
    }

    private function setVersions($versions)
    {
        /*
         *  ["versions"]=>
              array(5) {
                ["active_text"]=>
                string(5) "0.0.0"
                ["age_filter"]=>
                string(5) "2.1.0"
                ["matchmaker"]=>
                string(5) "2.1.0"
                ["trending"]=>
                string(6) "10.0.0"
                ["trending_active_text"]=>
                string(6) "10.0.0"
              }

         */

        foreach($versions as $version)
        {
            $this->addVersion($version);
        }
    }

    private function addVersion($version)
    {
        array_push($this->versions, $version);
    }

    public function getGlobals()
    {
        return $this->globals;
    }

    private function setGlobals($globals)
    {
        /*
         *  ["globals"]=>
              array(18) {
                ["friends"]=>
                bool(true)
                ["invite_type"]=>
                string(6) "client"
                ["recs_interval"]=>
                int(20000)
                ["updates_interval"]=>
                int(2000)
                ["recs_size"]=>
                int(40)
                ["matchmaker_default_message"]=>
                string(75) "I want you to meet someone. I introduced you on Tinder www.gotinder.com/app"
                ["share_default_text"]=>
                string(312) "<style>body{color:#fff;text-align:center;font-family:HelveticaNeue;text-shadow:0 1px 1px rgba(0,0,0,0.63);}h1{font-size:24px;line-height:24px;margin:0;}p{font-size:16px;margin:8px;}</style><h1>Get a Boost</h1><p><strong>Invite friends</strong> to show up <br/><strong>even higher</strong> in recommendations.</p>"
                ["boost_decay"]=>
                int(180)
                ["boost_up"]=>
                int(7)
                ["boost_down"]=>
                int(8)
                ["sparks"]=>
                bool(false)
                ["kontagent"]=>
                bool(false)
                ["sparks_enabled"]=>
                bool(false)
                ["kontagent_enabled"]=>
                bool(false)
                ["mqtt"]=>
                bool(false)
                ["tinder_sparks"]=>
                bool(true)
                ["moments_interval"]=>
                int(30000)
                ["plus"]=>
                bool(true)
              }

         */

        foreach($globals as $global)
        {
            $this->addGlobal($global);
        }
    }

    private function addGlobal($global)
    {
        array_push($this->globals, $global);
    }
} 