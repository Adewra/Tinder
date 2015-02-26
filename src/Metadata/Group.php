<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 12:46
 */

namespace Adewra\Tinder\Metadata;


class Group {

    private $type;
    private $key;
    private $subtype;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['type']))
            $this->setType($authenticationResponse['type']);

        if(isset($authenticationResponse['key']))
            $this->setKey($authenticationResponse['key']);

        if(isset($authenticationResponse['sub_type']))
            $this->setSubtype($authenticationResponse['sub_type']);
    }

    public function getType()
    {
        return $this->type;
    }

    private function setType($type)
    {
        $this->type = $type;
    }

    public function getKey()
    {
        return $this->key;
    }

    private function setKey($key)
    {
        $this->key = $key;
    }

    public function getSubtype()
    {
        return $this->subtype;
    }

    private function setSubtype($subtype)
    {
        $this->subtype = $subtype;
    }
}