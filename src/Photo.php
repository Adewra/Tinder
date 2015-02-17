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

namespace Adewra\Tinder;


class Photo {

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

    public function loadFromAuthenticationResponse($authenticationResponse)
    {

        if(isset($authenticationResponse['id']))
            $this->setIdentifier($authenticationResponse['id']);

        if(isset($authenticationResponse['url']))
            $this->setURL($authenticationResponse['url']);

        if(isset($authenticationResponse['processed_files']))
            $this->setProcessedFiles($authenticationResponse['processed_files']);

        if(isset($authenticationResponse['extension']))
            $this->setExtension($authenticationResponse['extension']);

        if(isset($authenticationResponse['fbId']))
            $this->setFacebookIdentifier($authenticationResponse['fbId']);

        if(isset($authenticationResponse['fileName']))
            $this->setFileName($authenticationResponse['fileName']);

        if(isset($authenticationResponse['main']))
            $this->setMain($authenticationResponse['main']);

        if(isset($authenticationResponse['xdistance_percent']))
            $this->setXDistancePercent($authenticationResponse['xdistance_percent']);

        if(isset($authenticationResponse['ydistance_percent']))
            $this->setYDistancePercent($authenticationResponse['ydistance_percent']);

        if(isset($authenticationResponse['xoffset_percent']))
            $this->setXOffsetPercent($authenticationResponse['xoffset_percent']);

        if(isset($authenticationResponse['yoffset_percent']))
            $this->setYOffsetPercent($authenticationResponse['yoffset_percent']);
    }

    public function getIdentifier()
    {
        return $this->id;
    }

    private function setIdentifier($identifier)
    {
        $this->id = $identifier;
    }

    public function getURL()
    {
        return $this->url;
    }

    private function setURL($url)
    {
        $this->url = $url;
    }

    public function getProcessedFiles()
    {
        return $this->processedFiles;
    }

    private function setProcessedFiles($processedFiles)
    {
        foreach($processedFiles as $processedFile) {
            array_push($this->processedFiles, $processedFile);
        }
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