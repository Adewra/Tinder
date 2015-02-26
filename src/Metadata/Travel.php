<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 12:11
 */

namespace Adewra\Tinder\Metadata;


class Travel {

    private $isTravelling;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['is_traveling']))
            $this->setIsTravelling($authenticationResponse['is_traveling']);
    }

    public function getIsTravelling()
    {
        return $this->isTravelling;
    }

    private function setIsTravelling($isTravelling)
    {
        $this->isTravelling = $isTravelling;
    }
}