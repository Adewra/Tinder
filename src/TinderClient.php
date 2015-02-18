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
use Adewra\Tinder\User;

class TinderClient {

    private $guzzleClient;
    private $tinderAuthenticationToken;
    private $user;

    function __construct()
    {
        $this->guzzleClient = new Client([
                'base_url' => ['https://api.gotinder.com', []],
                'defaults' => [
                    'headers' => [  'X-Auth-Token'  =>  '00000000-0000-4000-A000-000000000000',
                                    'Content-type'  =>  'application/json',
                                    //'app_version'   =>  3,
                                    //'platform'      =>  'ios',
                                    'User-agent'    =>  'Tinder Android Version 2.2.3',
                                    'os_version'    =>  '16',
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

        $guzzleResponse = $this->guzzleClient->post('/auth', ['body' => $payload, 'debug' => true]);
        if ($guzzleResponse->getBody())
        {
            $response = $guzzleResponse->json();
            $this->setTinderAuthenticationToken($response['token']);

            $user = new User($this->guzzleClient);
            $user->loadFromAuthenticationResponse($response['user']);
            $this->setTinderUser($user);
        }
    }


    public function getMatchesProfile($tinderIdentifier)
    {
        $guzzleResponse = $this->guzzleClient->post('/user/'.$tinderIdentifier, []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();
        }
    }

    public function getAllExistingData()
    {
        $payload = json_encode(
            array(
                //"last_activity_date" => "2015-02-15T22:15:21.353Z"
            )
        );

        $guzzleResponse = $this->guzzleClient->post('/updates', ['body' => $payload]);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();
        }
    }

    public function getUpdates($lastActivityDate)
    {
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

    public function getMomentsUpdates()
    {
        $guzzleResponse = $this->guzzleClient->post('/user/moments', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();
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

    public function getAssets()
    {
        $guzzleResponse = $this->guzzleClient->post('/assets', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");

        }
    }

    public function getMeta()
    {
        $guzzleResponse = $this->guzzleClient->post('/meta', []);
        if ($guzzleResponse->getBody()) {
            $response = $guzzleResponse->json();

            throw new \Exception("Not Implemented");

        }
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

        $guzzleResponse = $this->guzzleClient->post('/user/ping', ['body' => $payload]);
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