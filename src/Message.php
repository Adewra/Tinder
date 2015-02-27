<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      17/02/15 14:07
 */

namespace Adewra\Tinder;


class Message {

    private $identifier;
    private $matchIdentifier;
    private $to;
    private $from;
    private $message;
    private $sentDate;
    private $createdDate;
    private $timestamp;

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if (isset($response['_id']))
            $this->setIdentifier($response['_id']);

        if (isset($response['match_id']))
            $this->setMatchIdentifier($response['match_id']);

        if (isset($response['to']))
            $this->setTo($response['to']);

        if (isset($response['from']))
            $this->setFrom($response['from']);

        if (isset($response['message']))
            $this->setMessage($response['message']);

        if (isset($response['sent_date']))
            $this->setSentDate($response['sent_date']);

        if (isset($response['created_date']))
            $this->setCreatedDate($response['created_date']);

        if (isset($response['timestamp']))
            $this->setTimestamp($response['timestamp']);
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    private function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getMatchIdentifier()
    {
        return $this->matchIdentifier;
    }

    private function setMatchIdentifier($matchIdentifier)
    {
        $this->matchIdentifier = $matchIdentifier;
    }

    public function getTo()
    {
        return $this->to;
    }

    private function setTo($to)
    {
        $this->to = $to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    private function setFrom($from)
    {
        $this->from = $from;
    }

    public function getMessage()
    {
        return $this->message;
    }

    private function setMessage($message)
    {
        $this->message = $message;
    }

    public function getSentDate()
    {
        return $this->sentDate;
    }

    private function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    private function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    private function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
} 