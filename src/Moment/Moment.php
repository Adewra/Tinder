<?php
/**
 * Moment is used to represent media shared for a limited period with matches.
 *
 * Long description for class (if any)...
 *
 * @todo Add support for lines/graphics drawn over the media
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 14:42
 */

namespace Adewra\Tinder\Moment;

use Adewra\Tinder\Media;

class Moment {

    private $_id;
    private $createdBy;
    private $date;
    private $likesCount;
    private $media = array();
    private $text;
    private $textAttributes = array();
    private $filter;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if (isset($response['_id']))
            $this->setIdentifier($response['_id']);

        if (isset($response['created_by']))
            $this->setCreatedBy($response['created_by']);

        if (isset($response['date']))
            $this->setDate($response['date']);

        if (isset($response['likes_count']))
            $this->setLikesCount($response['likes_count']);

        //var_dump($response['media']);

        if (isset($response['media']))
            $this->setMedia($response['media']);

        if (isset($response['text']))
            $this->setText($response['text']);

        if (isset($response['text_attributes']))
            $this->setTextAttributes($response['text_attributes']);

        if (isset($response['filter']))
            $this->setFilter($response['filter']);
    }

    public function getIdentifier()
    {
        return $this->_id;
    }

    private function setIdentifier($identifier)
    {
        $this->_id = $identifier;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    private function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getDate()
    {
        return $this->date;
    }

    private function setDate($date)
    {
        $this->date = $date;
    }

    public function getLikesCount()
    {
        return $this->likesCount;
    }

    private function setLikesCount($likesCount)
    {
        $this->likesCount = $likesCount;
    }

    public function getMedia()
    {
        return $this->media;
    }

    private function setMedia($media)
    {
        $mediaObject = new Media\Media();
        $mediaObject->loadFromResponse($media);
        $this->addMedia($mediaObject);
    }

    private function addMedia(Media\Media $media)
    {
        array_push($this->media, $media);
    }

    public function getText()
    {
        return $this->text;
    }

    private function setText($text)
    {
        $this->text = $text;
    }

    public function getTextAttributes()
    {
        return $this->textAttributes;
    }

    private function setTextAttributes($textAttributes)
    {
        $this->textAttributes = $textAttributes;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    private function setFilter($filter)
    {
        $this->filter = $filter;
    }
}