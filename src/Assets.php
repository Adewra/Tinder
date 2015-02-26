<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 11:02
 */

namespace Adewra\Tinder;


class Assets {

    private $introductoryMoments = array();

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if (isset($response['intro_moments']))
            $this->setIntroductoryMoments($response['intro_moments']);

    }

    public function getIntroductoryMoments()
    {
        return $this->introductoryMoments;
    }

    private function setIntroductoryMoments($introductoryMoments)
    {
        $this->introductoryMoments = $introductoryMoments;
    }
}