<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      04/03/15 20:39
 */

namespace Adewra\Tinder\Media;


class Media {

    /* Fields */
    private $id;
    private $processedFiles = array();

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {

        if (isset($response['id']))
            $this->setIdentifier($response['id']);

        if(isset($response['processed_files']))
            $this->setProcessedFiles($response['processed_files']);

        if(isset($response['processedFiles']))
            $this->setProcessedFiles($response['processedFiles']);

    }

    public function getIdentifier()
    {
        return $this->id;
    }

    protected function setIdentifier($identifier)
    {
        $this->id = $identifier;
    }

    public function getProcessedFiles()
    {
        return $this->processedFiles;
    }

    protected function setProcessedFiles($processedFiles)
    {
        foreach($processedFiles as $processedFile) {
            array_push($this->processedFiles, $processedFile);
        }
    }

}