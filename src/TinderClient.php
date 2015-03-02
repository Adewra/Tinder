<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      17/02/15 09:10
 */

namespace Adewra\Tinder;

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception;
use Adewra\Tinder\User;

class TinderClient {

    private $guzzleClient;
    private $tinderAuthenticationToken;
    private $user;
    private $assets;
    private $metadata;

    function __construct()
    {
        $this->guzzleClient = new Client([
                'base_url' => ['https://api.gotinder.com', []],
                'defaults' => [
                    'headers' => [  'X-Auth-Token'  =>  '00000000-0000-4000-A000-000000000000',
                                    'Content-Type'  =>  'application/json',
                                    'User-Agent'    =>  'Tinder Android Version 2.2.3',
                                    'Accept'        =>  'application/json']
                ]
            ]);
    }

    public function getTinderAuthenticationToken()
    {
        return $this->tinderAuthenticationToken;
    }

    public function getUser()
    {
        return $this->user;
    }

    private function setTinderAuthenticationToken($token)
    {
        if(strlen($token) != 36)
            throw new Exception("The supplied Tinder Authentication Token is not in UUID4 format, it should be 36 characters long (including dashes).");

        //if(!preg_match("^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$", $token))
        //    throw new Exception("The supplied Tinder Authentication Token is not in UUID4 format.");

        $this->tinderAuthenticationToken = $token;
        $this->guzzleClient->setDefaultOption('headers/X-Auth-Token', $token);
    }

    private function setTinderUser(User $user)
    {
        $this->user = $user;
    }

    public function requestTinderAuthenticationToken($facebookIdentifier, $facebookAuthenticationToken)
    {
        $payload = json_encode(
            array(
                "locale" => "en-GB",
                "facebook_token" => $facebookAuthenticationToken,
                "facebook_id" => $facebookIdentifier
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/auth', ['body' => $payload]);
        try {
            if ($guzzleResponse->getBody()) {
                $response = $guzzleResponse->json();
                $this->setTinderAuthenticationToken($response['token']);

                $user = new User($this->guzzleClient);
                $user->loadFromAuthenticationResponse($response['user']);
                $this->setTinderUser($user);
            }
        }
        catch(Exception\ServerException $ex)
        {
            //if($ex->getCode() == 500)
            //    throw new \Exception("Unspecified error, check your Facebook Token.");
        }
    }


    public function getPerson($tinderIdentifier)
    {
        $guzzleResponse = $this->guzzleClient->get('/user/'.$tinderIdentifier, []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            $person = new Person($this->guzzleClient);
            $person->loadFromResponse($response['results']);

            // Do something with Status?

            return $person;
        }
    }

    public function getAllExistingData()
    {
        if($this->user == null)
            throw new \Exception("Cannot load existing data without a user being loaded first.");

        // To load up exiting data and not a delta update, the payload must be empty.
        $payload = json_encode(
            array(
                //"last_activity_date" => "2015-02-15T22:15:21.353Z"
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/updates', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();
            foreach($response['matches'] as $match)
            {
                $matchObject = new Match();
                $matchObject->loadFromResponse($match);
                $this->user->addMatch($matchObject);
            }
            foreach($response['blocks'] as $block)
            {
                $this->user->addBlock($block);
            }
            foreach($response['lists'] as $list)
            {
                $this->user->addList($list);
            }
            foreach($response['deleted_lists'] as $deletedList)
            {
                $this->user->addDeletedList($deletedList);
            }

            // Do something with Last Activity Date?
        }
    }

    public function getUpdates($lastActivityDate)
    {
        if($this->user == null)
            throw new \Exception("Cannot load updated data without a user being loaded first.");

        $payload = json_encode(
            array(
                "last_activity_date" => "2015-02-15T22:15:21.353Z"
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/updates', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();
        }
    }

    public function getUsersMoments()
    {
        $guzzleResponse = $this->guzzleClient->get('/user/moments', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            $this->user->setMoments($response['moments']);

            // Do something with Last Activity Date?
        }
    }

    public function getUsersMomentsLikes()
    {
        $payload = json_encode(
            array(
                "last_moment_id" => "",
                "last_activity_date" => ""
            )
        );

        $guzzleResponse = $this->guzzleClient->get('/feed/likes', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            $this->user->setMomentsLikes($response['likes']);

            // Do something with Last Activity Date?
        }
    }

    public function getMomentsFeed()
    {
        $payload = json_encode(
            array(
                "last_moment_id" => "",
                "last_activity_date" => ""
            )
        );

        $guzzleResponse = $this->guzzleClient->get('/feed/moments', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            $this->user->setMomentsFeed($response['moments']);

            // Do something with Last Activity Date?
        }
    }

    public function getRecommendations()
    {
        $guzzleResponse = $this->guzzleClient->post('/user/recs', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");

        }
    }

    public function requestAssets()
    {
        $guzzleResponse = $this->guzzleClient->get('/assets', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            $assets = new Assets();
            $assets->loadFromResponse($response);
            $this->setAssets($assets);
        }
    }

    public function getAssets()
    {
        return $this->assets;
    }

    private function setAssets(Assets $assets)
    {
        $this->assets = $assets;
    }

    public function requestMetadata()
    {
        $guzzleResponse = $this->guzzleClient->get('/meta', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            $meta = new Metadata();
            $meta->loadFromResponse($response);
            $this->setMetadata($meta);

        }
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    private function setMetadata(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    public function updateiOSAppSettings()
    {
        $payload = json_encode(
            array(
                "message_push" => true,
                "match_push" => true,
                "moment_like_push" => true,
                "app_id" => "com.cardify.tinder",
                "device_token" => "99e603c8ad3ddbdf04376760061b8f9f76db355b55490bd70bb26de4a8031827",
                "match_request_push"=> true
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/user/devices/ios', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");
        }
    }

    public function updateLocation($latitude, $longitude)
    {
        $payload = json_encode(
            array(
                "lat" => $latitude,
                "lon" => $longitude
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/user/ping', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");
        }
    }

    public function likeSomebody($tinderIdentifier)
    {
        $guzzleResponse = $this->guzzleClient->post('/like/'.$tinderIdentifier, []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");

            if($response['match'] == true) {

            } else if($response['match'] == false) {

            }

        }
    }

    public function passSomebody($tinderIdentifier)
    {
        $guzzleResponse = $this->guzzleClient->post('/pass/'.$tinderIdentifier, []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");

            if($response['match'] == true) {

            } else if($response['match'] == false) {

            }
        }
    }

    public function reportUser($tinderIdentifier, $cause)
    {
        $payload = json_encode(
            array(
                "cause" => $cause
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/report/'.$tinderIdentifier, ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();
        }
    }
} 