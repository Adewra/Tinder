<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 12:36
 */

namespace Adewra\Tinder\Metadata;


class Versions {

    private $activeText;
    private $ageFilter;
    private $matchmaker;
    private $trending;
    private $trendingActiveText;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['active_text']))
            $this->setActiveText($authenticationResponse['active_text']);

        if(isset($authenticationResponse['age_filter']))
            $this->setAgeFilter($authenticationResponse['age_filter']);

        if(isset($authenticationResponse['matchmaker']))
            $this->setMatchmaker($authenticationResponse['matchmaker']);

        if(isset($authenticationResponse['trending']))
            $this->setTrending($authenticationResponse['trending']);

        if(isset($authenticationResponse['trending_active_text']))
            $this->setTrendingActiveText($authenticationResponse['trending_active_text']);
    }

    public function getActiveText()
    {
        return $this->activeText;
    }

    private function setActiveText($activeText)
    {
        $this->activeText = $activeText;
    }

    public function getAgeFilter()
    {
        return $this->ageFilter;
    }

    private function setAgeFilter($ageFilter)
    {
        $this->ageFilter = $ageFilter;
    }

    public function getMatchmaker()
    {
        return $this->matchmaker;
    }

    private function setMatchmaker($matchmaker)
    {
        $this->matchmaker = $matchmaker;
    }

    public function getTrending()
    {
        return $this->trending;
    }

    private function setTrending($trending)
    {
        $this->trending = $trending;
    }

    public function getTrendingActiveText()
    {
        return $this->trendingActiveText;
    }

    private function setTrendingActiveText($trendingActiveText)
    {
        $this->trendingActiveText = $trendingActiveText;
    }
}