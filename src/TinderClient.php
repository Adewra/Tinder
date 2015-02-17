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
        $this->$guzzleClient = new Client([
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