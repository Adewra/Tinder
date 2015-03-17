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

use Adewra\Tinder\Moment\Moment;
use Adewra\Tinder\Moment\MomentLike;
use GuzzleHttp\Client;

class User extends Person {

    /* Fields */
    private $guzzleClient;
    private $matches = array();
    private $blocks = array();
    private $lists = array();
    private $deletedLists = array();
    private $momentsFeed = array();
    private $momentsLikes = array();
    private $recommendations = array();

    private $activeTime;
    private $createDate;
    private $ageFilterMax;
    private $ageFilterMin;
    private $apiToken;
    private $distanceFilter;
    private $fullName;
    private $groups = array();
    private $genderFilter;
    private $discoverable;

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
    }

    public function fetchUpdates()
    {
        $guzzleResponse = $this->guzzleClient->get('/updates', []);
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

    public function getMatches()
    {
        return $this->matches;
    }

    private function setMatches($matches)
    {
        foreach($matches as $match)
        {
            $this->addMatch($match);
        }
    }

    public function addMatch(Match $match)
    {
        array_push($this->matches, $match);
    }

    public function getMessages()
    {
        if(sizeof($this->matches) == 0) return 0;

        $messages = array();

        foreach($this->matches as $match)
        {
            foreach($match->getMessages() as $message)
            {
                array_push($messages, $message);
            }
        }

        return $messages;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function addBlock($block)
    {
        array_push($this->blocks, $block);
    }

    public function getLists()
    {
        return $this->lists;
    }

    public function addList($list)
    {
        array_push($this->lists, $list);
    }

    public function getDeletedLists()
    {
        return $this->deletedLists;
    }

    public function addDeletedList($deletedList)
    {
        array_push($this->deletedLists, $deletedList);
    }

    public function getMomentsFeed()
    {
        return $this->momentsFeed;
    }

    public function setMomentsFeed($momentsFeed)
    {
        foreach($momentsFeed as $momentInFeed)
        {
            $momentObject = new Moment();
            $momentObject->loadFromResponse($momentInFeed);
            $this->addMomentInFeed($momentObject);
        }
    }

    private function addMomentInFeed(Moment $moment)
    {
        array_push($this->momentsFeed, $moment);
    }

    public function getMomentsLikes()
    {
        return $this->momentsLikes;
    }

    public function setMomentsLikes($momentsLikes)
    {
        foreach($momentsLikes as $momentsLike)
        {
            $momentLikeObject = new MomentLike();
            $momentLikeObject->loadFromResponse($momentsLike);
            $this->addMomentLike($momentLikeObject);
        }
    }

    private function addMomentLike(MomentLike $momentLike)
    {
        array_push($this->momentsLikes, $momentLike);
    }

    public function getRecommendations()
    {
        return $this->recommendations;
    }

    public function setRecommendations($recommendations)
    {
        foreach($recommendations as $recommendation)
        {
            $recommendationObject = new Recommendation();
            $recommendationObject->loadFromResponse($recommendation);
            $this->addRecommendation($recommendationObject);
        }
    }

    private function addRecommendation(Recommendation $recommendation)
    {
        array_push($this->recommendations, $recommendation);
    }
} 