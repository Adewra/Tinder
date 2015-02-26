<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      25/02/15 21:34
 */

namespace Adewra\Tinder;


class Match {

    private $_id;
    private $closed;
    private $commonFriendCount;
    private $commonLikeCount;
    private $createdDate;
    private $dead;
    private $lastActivityDate;
    private $messageCount;
    private $messages = array();
    private $participants = array();
    private $pending;
    private $notFollowing = array();
    private $person;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if (isset($response['_id']))
            $this->setIdentifier($response['_id']);

        if (isset($response['closed']))
            $this->setClosed($response['closed']);

        if (isset($response['common_friend_count']))
            $this->setCommonFriendCount($response['common_friend_count']);

        if (isset($response['common_like_count']))
            $this->setCommonLikeCount($response['common_like_count']);

        if (isset($response['created_date']))
            $this->setCreatedDate($response['created_date']);

        if (isset($response['dead']))
            $this->setDead($response['dead']);

        if (isset($response['last_activity_date']))
            $this->setLastActivityDate($response['last_activity_date']);

        if (isset($response['message_count']))
            $this->setMessageCount($response['message_count']);

        if (isset($response['messages']))
            $this->setMessages($response['messages']);

        if (isset($response['participants']))
            $this->setParticipants($response['participants']);

        if (isset($response['pending']))
            $this->setPending($response['pending']);

        if (isset($response['not_following']))
            $this->setNotFollowing($response['not_following']);

        if (isset($response['person']))
            $this->setPerson($response['person']);
    }

    public function getIdentifier()
    {
        return $this->_id;
    }

    private function setIdentifier($identifier)
    {
        $this->_id = $identifier;
    }

    public function getClosed()
    {
        return $this->closed;
    }

    private function setClosed($closed)
    {
        $this->closed = $closed;
    }

    public function getCommonFriendCount()
    {
        return $this->commonFriendCount;
    }

    private function setCommonFriendCount($commonFriendCount)
    {
        $this->commonFriendCount = $commonFriendCount;
    }

    public function getCommonLikeCount()
    {
        return $this->commonLikeCount;
    }

    private function setCommonLikeCount($commonLikeCount)
    {
        $this->commonLikeCount = $commonLikeCount;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    private function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function getDead()
    {
        return $this->dead;
    }

    private function setDead($dead)
    {
        $this->dead = $dead;
    }

    public function getLastActivityDate()
    {
        return $this->lastActivityDate;
    }

    private function setLastActivityDate($lastActivityDate)
    {
        $this->lastActivityDate = $lastActivityDate;
    }

    public function getMessageCount()
    {
        return $this->messageCount;
    }

    private function setMessageCount($messageCount)
    {
        $this->messageCount = $messageCount;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    private function setMessages($messages)
    {
        foreach($messages as $message)
        {
            $messageObject = new Message();
            $messageObject->loadFromResponse($message);
            $this->addMessage($messageObject);
        }
    }

    private function addMessage(Message $message)
    {
        array_push($this->messages, $message);
    }

    public function getParticipants()
    {
        return $this->participants;
    }

    private function setParticipants($participants)
    {
        foreach($participants as $participant)
        {
            $this->addParticipant($participant);
        }
    }

    private function addParticipant($participant)
    {
        array_push($this->participants, $participant);
    }

    public function getPending()
    {
        return $this->pending;
    }

    private function setPending($pending)
    {
        $this->pending = $pending;
    }

    public function getNotFollowing()
    {
        return $this->notFollowing;
    }

    private function setNotFollowing($notFollowing)
    {
        foreach($notFollowing as $key => $value)
        {
            $this->addNotFollowing($key, $value);
        }
    }

    private function addNotFollowing($follower, $following)
    {
        array_merge($this->notFollowing, array($follower => $following));
    }

    public function getPerson()
    {
        return $this->person;
    }

    private function setPerson($person)
    {
        $personObject = new Person();
        $personObject->loadFromResponse($person);
        $this->person = $personObject;
    }
}