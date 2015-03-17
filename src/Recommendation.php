<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      16/03/15 10:06
 */

namespace Adewra\Tinder;

use Adewra\Tinder\Person;

class Recommendation {

    private $distanceInMiles;
    private $commonLikeCount;
    private $commonFriendCount;
    private $commonLikes;
    private $commonFriends;
    private $person;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($response['distance_mi']))
            $this->setDistanceInMiles($response['distance_mi']);

        if(isset($response['common_like_count']))
            $this->setCommonLikeCount($response['common_like_count']);

        if(isset($response['common_friend_count']))
            $this->setCommonFriendCount($response['common_friend_count']);

        if(isset($response['common_likes']))
            $this->setCommonLikes($response['common_likes']);

        if(isset($response['common_friends']))
            $this->setCommonFriends($response['common_friends']);

        $this->setPerson($response);
    }

    public function getDistanceInMiles()
    {
        return $this->distanceInMiles;
    }

    protected function setDistanceInMiles($distance)
    {
        $this->distanceInMiles = $distance;
    }

    public function getCommonLikeCount()
    {
        return $this->commonLikeCount;
    }

    protected function setCommonLikeCount($commonLikeCount)
    {
        $this->commonLikeCount = $commonLikeCount;
    }

    public function getCommonFriendCount()
    {
        return $this->commonFriendCount;
    }

    protected function setCommonFriendCount($commonFriendCount)
    {
        $this->commonFriendCount = $commonFriendCount;
    }

    public function getCommonLikes()
    {
        return $this->commonLikes;
    }

    protected function setCommonLikes($commonLikes)
    {
        $this->commonLikes = $commonLikes;
    }

    public function getCommonFriends()
    {
        return $this->commonFriends;
    }

    protected function setCommonFriends($commonFriends)
    {
        $this->commonFriends = $commonFriends;
    }

    public function getPerson()
    {
        return $this->person;
    }

    protected function setPerson($response)
    {
        $personObject = new Person();
        $personObject->loadFromResponse($response);
        $this->person = $personObject;
    }
}