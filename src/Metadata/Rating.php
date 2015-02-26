<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 12:08
 */

namespace Adewra\Tinder\Metadata;

class Rating {

    private $likesRemaining;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['likes_remaining']))
            $this->setLikesRemaining($authenticationResponse['likes_remaining']);
    }

    public function getLikesRemaining()
    {
        return $this->likesRemaining;
    }

    private function setLikesRemaining($likesRemaining)
    {
        $this->likesRemaining = $likesRemaining;
    }
}