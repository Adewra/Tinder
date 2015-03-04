<?php
/**
 * Globals holds the global variables used within the Tinder application.
 *
 * Globals holds the global variables used within the Tinder application.
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 13:10
 */

namespace Adewra\Tinder\Metadata;


class Globals {

    /* Intervals */
    private $recommendationsInterval;
    private $updatesInterval;
    private $momentsInterval;
    private $advertisingSwipeInterval;

    /* Boost feature */
    private $boostDecay;
    private $boostUp;
    private $boostDown;

    /* Analytics */
    private $kontagent;
    private $kontagentEnabled;

    private $inviteType;
    private $recommendationsSize;
    private $matchmakerDefaultMessage;
    private $shareDefaultText;
    private $sparks;
    private $sparksEnabled;
    private $mqtt;
    private $tinderSparks;
    private $plus;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['invite_type']))
            $this->setInviteType($authenticationResponse['invite_type']);

        if(isset($authenticationResponse['recs_interval']))
            $this->setRecommendationsInterval($authenticationResponse['recs_interval']);

        if(isset($authenticationResponse['updates_interval']))
            $this->setUpdatesInterval($authenticationResponse['updates_interval']);

        if(isset($authenticationResponse['recs_size']))
            $this->setRecommendationsSize($authenticationResponse['recs_size']);

        if(isset($authenticationResponse['matchmaker_default_message']))
            $this->setMatchmakerDefaultMessage($authenticationResponse['matchmaker_default_message']);

        if(isset($authenticationResponse['share_default_text']))
            $this->setShareDefaultText($authenticationResponse['share_default_text']);

        if(isset($authenticationResponse['boost_decay']))
            $this->setBoostDecay($authenticationResponse['boost_decay']);

        if(isset($authenticationResponse['boost_up']))
            $this->setBoostUp($authenticationResponse['boost_up']);

        if(isset($authenticationResponse['boost_down']))
            $this->setBoostDown($authenticationResponse['boost_down']);

        if(isset($authenticationResponse['sparks']))
            $this->setSparks($authenticationResponse['sparks']);

        if(isset($authenticationResponse['kontagent']))
            $this->setKontagent($authenticationResponse['kontagent']);

        if(isset($authenticationResponse['sparks_enabled']))
            $this->setSparksEnabled($authenticationResponse['sparks_enabled']);

        if(isset($authenticationResponse['kontagent_enabled']))
            $this->setKontagentEnabled($authenticationResponse['kontagent_enabled']);

        if(isset($authenticationResponse['mqtt']))
            $this->setMQTT($authenticationResponse['mqtt']);

        if(isset($authenticationResponse['tinder_sparks']))
            $this->setTinderSparks($authenticationResponse['tinder_sparks']);

        if(isset($authenticationResponse['moments_interval']))
            $this->setMomentsInterval($authenticationResponse['moments_interval']);

        if(isset($authenticationResponse['ad_swipe_interval']))
            $this->setAdvertisingSwipeInterval($authenticationResponse['ad_swipe_interval']);

        if(isset($authenticationResponse['plus']))
            $this->setPlus($authenticationResponse['plus']);
    }

    public function getInviteType()
    {
        return $this->inviteType;
    }

    private function setInviteType($inviteType)
    {
        $this->inviteType = $inviteType;
    }

    public function getRecommendationsInterval()
    {
        return $this->recommendationsInterval;
    }

    private function setRecommendationsInterval($recommendationsInterval)
    {
        $this->recommendationsInterval = $recommendationsInterval;
    }

    public function getUpdatesInterval()
    {
        return $this->updatesInterval;
    }

    private function setUpdatesInterval($updatesInterval)
    {
        $this->updatesInterval = $updatesInterval;
    }

    public function getRecommendationsSize()
    {
        return $this->recommendationsSize;
    }

    private function setRecommendationsSize($recommendationsSize)
    {
        $this->recommendationsSize = $recommendationsSize;
    }

    public function getMatchmakerDefaultMessage()
    {
        return $this->matchmakerDefaultMessage;
    }

    private function setMatchmakerDefaultMessage($matchmakerDefaultMessage)
    {
        $this->matchmakerDefaultMessage = $matchmakerDefaultMessage;
    }

    public function getShareDefaultText()
    {
        return $this->shareDefaultText;
    }

    private function setShareDefaultText($shareDefaultText)
    {
        $this->shareDefaultText = $shareDefaultText;
    }

    public function getBoostDecay()
    {
        return $this->boostDecay;
    }

    private function setBoostDecay($boostDecay)
    {
        $this->boostDecay = $boostDecay;
    }

    public function getBoostUp()
    {
        return $this->boostUp;
    }

    private function setBoostUp($boostUp)
    {
        $this->boostUp = $boostUp;
    }

    public function getBoostDown()
    {
        return $this->boostDown;
    }

    private function setBoostDown($boostDown)
    {
        $this->boostDown = $boostDown;
    }

    public function getSparks()
    {
        return $this->sparks;
    }

    private function setSparks($sparks)
    {
        $this->sparks = $sparks;
    }

    public function getKontagent()
    {
        return $this->kontagent;
    }

    private function setKontagent($kontagent)
    {
        $this->kontagent = $kontagent;
    }

    public function getSparksEnabled()
    {
        return $this->sparksEnabled;
    }

    private function setSparksEnabled($sparksEnabled)
    {
        $this->sparksEnabled = $sparksEnabled;
    }

    public function getKontagentEnabled()
    {
        return $this->kontagentEnabled;
    }

    private function setKontagentEnabled($kontagentEnabled)
    {
        $this->kontagentEnabled = $kontagentEnabled;
    }

    public function getMQTT()
    {
        return $this->mqtt;
    }

    private function setMQTT($MQTT)
    {
        $this->mqtt = $MQTT;
    }

    public function getTinderSparks()
    {
        return $this->tinderSparks;
    }

    private function setTinderSparks($tinderSparks)
    {
        $this->tinderSparks = $tinderSparks;
    }

    public function getMomentsInterval()
    {
        return $this->momentsInterval;
    }

    private function setMomentsInterval($momentsInterval)
    {
        $this->momentsInterval = $momentsInterval;
    }

    public function getAdvertisingSwipeInterval()
    {
        return $this->advertisingSwipeInterval;
    }

    private function setAdvertisingSwipeInterval($advertisingSwipeInterval)
    {
        $this->advertisingSwipeInterval = $advertisingSwipeInterval;
    }

    public function getPlus()
    {
        return $this->plus;
    }

    private function setPlus($plus)
    {
        $this->plus = $plus;
    }
}