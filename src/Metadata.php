<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 11:21
 */

namespace Adewra\Tinder;

class Metadata {

    private $status;
    private $notifications = array();
    private $groups = array();
    private $rating;
    private $travel;
    private $versions = array();
    private $globals = array();
    private $purchases = array();

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['status']))
            $this->setStatus($authenticationResponse['status']);

        if(isset($authenticationResponse['notifications']))
            $this->setNotifications($authenticationResponse['notifications']);

        if(isset($authenticationResponse['groups']))
            $this->setGroups($authenticationResponse['groups']);

        if(isset($authenticationResponse['rating']))
            $this->setRating($authenticationResponse['rating']);

        if(isset($authenticationResponse['travel']))
            $this->setTravel($authenticationResponse['travel']);

        if(isset($authenticationResponse['purchases']))
            $this->setPurchases($authenticationResponse['purchases']);

        if(isset($authenticationResponse['versions']))
            $this->setVersions($authenticationResponse['versions']);

        if(isset($authenticationResponse['globals']))
            $this->setGlobals($authenticationResponse['globals']);
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function setStatus($status)
    {
        $this->status = $status;
    }

    public function getNotifications()
    {
        return $this->notifications;
    }

    private function setNotifications($notifications)
    {
        foreach($notifications as $notification)
        {
            $this->addNotification($notification);
        }
    }

    private function addNotification($notification)
    {
        array_push($this->notifications, $notification);
    }

    public function getGroups()
    {
        return $this->groups;
    }

    private function setGroups($groups)
    {
        foreach($groups as $group)
        {
            $groupObject = new Metadata\Group();
            $groupObject->loadFromResponse($group);
            $this->addGroup($group);
        }
    }

    private function addGroup(Group $group)
    {
        array_push($this->groups, $group);
    }

    public function getRating()
    {
        return $this->rating;
    }

    private function setRating($rating)
    {
        $rating = new Metadata\Rating();
        $rating->loadFromResponse($rating);
        $this->rating = $rating;
    }

    public function getTravel()
    {
        return $this->travel;
    }

    private function setTravel($travel)
    {
        $travel = new Metadata\Travel();
        $travel->loadFromResponse($travel);
        $this->travel = $travel;
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
        $versions = new Metadata\Versions();
        $versions->loadFromResponse($versions);
        $this->versions = $versions;
    }

    public function getGlobals()
    {
        return $this->globals;
    }

    private function setGlobals($globals)
    {
        $globals = new Metadata\Globals();
        $globals->loadFromResponse($globals);
        $this->globals = $globals;
    }
}