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

class Tinder {

    private $client;

    function __construct()
    {
        $this->client = new Client([
                'base_url' => ['https://api.gotinder.com/'],
                'defaults' => [
                    'headers' => [  'X-Auth-Token'  =>  '00000000-0000-4000-A000-000000000000',
                                    'Content-type'  =>  'application/json',
                                    'app_version'   =>  3,
                                    'platform'      =>  'ios',
                                    'User-agent'    =>  'User-Agent: Tinder/3.0.4 (iPhone; iOS 7.1; Scale/2.00)',
                                    'os_version'    =>  '700001',
                                    'Accept'        =>  'application/json']
                ]
            ]);
    }

    function setAuthenticationToken($token)
    {
        if(strlen($token) != 36)
            throw new Exception("The supplied Authentication Token is not in UUID4 format, it should be 36 characters long (including dashes).");

        if(!preg_match("^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$", $token))
            throw new Exception("The supplied Authentication Token is not in UUID4 format.");

        $this->client->setDefaultOption('headers/X-Auth-Token', $token);
    }
} 