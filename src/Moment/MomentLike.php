<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 15:18
 */

namespace Adewra\Tinder\Moment;


class MomentLike {

    private $date;
    private $likedBy;
    private $moment;
    private $thumbnail;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($response['date']))
            $this->setDate($response['date']);

        if(isset($response['liked_by']))
            $this->setLikedBy($response['liked_by']);

        if(isset($response['moment']))
            $this->setMoment($response['moment']);

        if(isset($response['thumb']))
            $this->setThumbnail($response['thumb']);
    }

    public function getDate()
    {
        return $this->date;
    }

    private function setDate($date)
    {
        $this->date = $date;
    }

    public function getLikedBy()
    {
        return $this->likedBy;
    }

    private function setLikedBy($likedBy)
    {
        $this->likedBy = $likedBy;
    }

    public function getMoment()
    {
        return $this->moment;
    }

    private function setMoment($moment)
    {
        $this->moment = $moment;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    private function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }
}