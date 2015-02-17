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

    function loadFromAuthenticationResponse($authenticationResponse)
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

    function getIdentifier()
    {
        return $this->id;
    }

    function setIdentifier($identifier)
    {
        $this->id = $identifier;
    }

    function getURL()
    {
        return $this->url;
    }

    function setURL($url)
    {
        $this->url = $url;
    }

    function getProcessedFiles()
    {
        return $this->processedFiles;
    }

    function setProcessedFiles($processedFiles)
    {
        foreach($processedFiles as $processedFile) {
            array_push($this->processedFiles, $processedFile);
        }
    }

    function getExtension()
    {
        return $this->extension;
    }

    function setExtension($extension)
    {
        $this->extension = $extension;
    }

    function getFacebookIdentifier()
    {
        return $this->fbId;
    }

    function setFacebookIdentifier($facebookIdentifier)
    {
        $this->fbId = $facebookIdentifier;
    }

    function getFileName()
    {
        return $this->fileName;
    }

    function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    function getMain()
    {
        return $this->main;
    }

    function setMain($main)
    {
        $this->main = $main;
    }

    function getYDistancePercent()
    {
        return $this->yDistancePercent;
    }

    function setYDistancePercent($yDistancePercent)
    {
        $this->yDistancePercent = $yDistancePercent;
    }

    function getXDistancePercent()
    {
        return $this->xDistancePercent;
    }

    function setXDistancePercent($xDistancePercent)
    {
        $this->xDistancePercent = $xDistancePercent;
    }

    function getYOffsetPercent()
    {
        return $this->yOffsetPercent;
    }

    function setYOffsetPercent($yOffsetPercent)
    {
        $this->yOffsetPercent = $yOffsetPercent;
    }

    function getXOffsetPercent()
    {
        return $this->xOffsetPercent;
    }

    function setXOffsetPercent($xOffsetPercent)
    {
        $this->xOffsetPercent = $xOffsetPercent;
    }
} 