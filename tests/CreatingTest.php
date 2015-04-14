<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      16/03/15 10:39
 */

require 'vendor/autoload.php';

use Adewra\Tinder\TinderClient;

class CreatingTest extends PHPUnit_Framework_TestCase {

    private $allowChangingOfData = false;
    private $tinderClient;

    public function __construct()
    {
        // Setup
        $this->tinderClient = new TinderClient();

        //Execute
        $this->tinderClient->requestTinderAuthenticationToken("507665705",
            "CAAGm0PX4ZCpsBADG580hqZBftJB4eC92WWDZCZBgO9z6Rd8mjOZC67hJ5ZA7kRfrSo2h5qeVJL22cjTjcxlnWHa3xRGKEDB1hYm1lIa0H6ObiVMiG9CmRrncR2uKdrcwMnw1gDjKZCyf7Wkix9oVLMmR0MunrArMxKZBBCc0ppvMXr49DzOGsRJ1UDju1tiJmmWkizNnJMJoT0zL1MKJAWUx");

    }

    public function testCanCreateNewAccount()
    {
        throw new Exception("Not yet implemented");
    }

    public function testCanCreateNewMoment()
    {
        throw new Exception("Not yet implemented");
        //$this->tinderClient->createNewMoment();
    }

    public function testCanCreateNewMessage()
    {
        throw new Exception("Not yet implemented");
    }

    public function testCanAddNewPhoto()
    {
        throw new Exception("Not yet implemented");
    }
}
