<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      17/02/15 13:00
 */

namespace Adewra\Tinder\Media;


class Photo extends Media {

    /* Fields */
    private $id;
    private $url;
    private $processedFiles = array();
    private $extension;
    private $fbId;
    private $fileName;
    private $main;
    private $xDistancePercent;
    private $yDistancePercent;
    private $xOffsetPercent;
    private $yOffsetPercent;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {

        if(isset($response['id']))
            $this->setIdentifier($response['id']);

        if(isset($response['url']))
            $this->setURL($response['url']);

        if(isset($response['processed_files']))
            $this->setProcessedFiles($response['processed_files']);

        if(isset($response['extension']))
            $this->setExtension($response['extension']);

        if(isset($response['fbId']))
            $this->setFacebookIdentifier($response['fbId']);

        if(isset($response['fileName']))
            $this->setFileName($response['fileName']);

        if(isset($response['main']))
            $this->setMain($response['main']);

        if(isset($response['xdistance_percent']))
            $this->setXDistancePercent($response['xdistance_percent']);

        if(isset($response['ydistance_percent']))
            $this->setYDistancePercent($response['ydistance_percent']);

        if(isset($response['xoffset_percent']))
            $this->setXOffsetPercent($response['xoffset_percent']);

        if(isset($response['yoffset_percent']))
            $this->setYOffsetPercent($response['yoffset_percent']);
    }

    public function getURL()
    {
        return $this->url;
    }

    private function setURL($url)
    {
        $this->url = $url;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    private function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getFacebookIdentifier()
    {
        return $this->fbId;
    }

    private function setFacebookIdentifier($facebookIdentifier)
    {
        $this->fbId = $facebookIdentifier;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    private function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getMain()
    {
        return $this->main;
    }

    private function setMain($main)
    {
        $this->main = $main;
    }

    public function getYDistancePercent()
    {
        return $this->yDistancePercent;
    }

    private function setYDistancePercent($yDistancePercent)
    {
        $this->yDistancePercent = $yDistancePercent;
    }

    public function getXDistancePercent()
    {
        return $this->xDistancePercent;
    }

    private function setXDistancePercent($xDistancePercent)
    {
        $this->xDistancePercent = $xDistancePercent;
    }

    public function getYOffsetPercent()
    {
        return $this->yOffsetPercent;
    }

    private function setYOffsetPercent($yOffsetPercent)
    {
        $this->yOffsetPercent = $yOffsetPercent;
    }

    public function getXOffsetPercent()
    {
        return $this->xOffsetPercent;
    }

    private function setXOffsetPercent($xOffsetPercent)
    {
        $this->xOffsetPercent = $xOffsetPercent;
    }
} 