<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      17/02/15 09:55
 */

require 'vendor/autoload.php';

use Adewra\Tinder\TinderClient;

class ReadingTest extends PHPUnit_Framework_TestCase {

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

    public function testCanFetchTinderAuthenticationToken()
    {
        $this->assertNotNull($this->tinderClient->getTinderAuthenticationToken());
        $this->assertNotEquals("00000000-0000-4000-A000-000000000000", $this->tinderClient->getTinderAuthenticationToken());
        //$this->assertEquals("933de757-8db4-4582-ab24-0e77fcdfdd53", $this->tinderClient->getTinderAuthenticationToken());
    }

    public function testCanFetchUser()
    {
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser->getIdentifier());
        $this->assertNotNull($currentUser->getActiveTime());
        $this->assertNotNull($currentUser->getCreateDate());
        $this->assertNotNull($currentUser->getAgeFilterMaximum());
        $this->assertNotNull($currentUser->getAgeFilterMinimum());
        $this->assertNotNull($currentUser->getAPIToken());
        $this->assertNotNull($currentUser->getBio());
        $this->assertNotNull($currentUser->getBirthDate());
        $this->assertNotNull($currentUser->getDistanceFilter());
        $this->assertNotNull($currentUser->getFullName());
        $this->assertNotNull($currentUser->getGroups());
        $this->assertNotNull($currentUser->getGender());
        $this->assertNotNull($currentUser->getGenderFilter());
        $this->assertNotNull($currentUser->getName());
        $this->assertNotNull($currentUser->getPingTime());
        $this->assertNotNull($currentUser->getDiscoverable());
    }

    public function testCanFetchUsersMatches()
    {
        $this->tinderClient->getAllExistingData();
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser);

        $this->assertNotNull($currentUser->getMatches());
        $this->assertEquals(45, sizeof($currentUser->getMatches()));
    }

    public function testCanFetchUsersMessages()
    {
        $this->tinderClient->getAllExistingData();
        $currentUser = $this->tinderClient->getUser();

        $this->assertNotNull($currentUser->getMatches());
        $this->assertNotNull($currentUser->getMessages());
        $this->assertEquals(630, sizeof($currentUser->getMessages()));
    }

    public function testCanFetchUsersMoments()
    {
        $this->tinderClient->getUsersMoments();
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser);

        $this->assertNotNull($currentUser->getMoments());
        $this->assertEquals(4, sizeof($currentUser->getMoments()));
    }

    public function testCanFetchUsersPhotos()
    {
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser);

        $photos = $currentUser->getPhotos();
        $this->assertNotNull($photos);
        $this->assertEquals(3, sizeof($photos));

        foreach($photos as $photo)
        {
            $this->assertNotNull($photo->getIdentifier());
            $this->assertNotNull($photo->getURL());
            $this->assertNotNull($photo->getExtension());
            $this->assertNotNull($photo->getFacebookIdentifier());
            $this->assertNotNull($photo->getFileName());
            $this->assertNotNull($photo->getMain());
            $this->assertNotNull($photo->getXDistancePercent());
            $this->assertNotNull($photo->getYDistancePercent());
            $this->assertNotNull($photo->getXOffsetPercent());
            $this->assertNotNull($photo->getYOffsetPercent());
        }
    }

    public function testCanFetchUsersBlocks()
    {
        $this->tinderClient->getAllExistingData();
        $currentUser = $this->tinderClient->getUser();

        $this->assertNotNull($currentUser);
        $this->assertEquals(19, sizeof($currentUser->getBlocks()));
    }

    public function testCanFetchUsersLists()
    {
        $this->tinderClient->getAllExistingData();
        $currentUser = $this->tinderClient->getUser();

        $this->assertNotNull($currentUser);
        $this->assertEquals(0, sizeof($currentUser->getLists()));
    }

    public function testCanFetchUsersDeletedLists()
    {
        $this->tinderClient->getAllExistingData();
        $currentUser = $this->tinderClient->getUser();

        $this->assertNotNull($currentUser);
        $this->assertEquals(0, sizeof($currentUser->getDeletedLists()));
    }

    public function testCanFetchUsersRecommendations()
    {
        if ($this->allowChangingOfData)
        {
            $this->tinderClient->getRecommendations();
            $currentUser = $this->tinderClient->getUser();
            $this->assertNotNull($currentUser);

            $this->assertNotNull($currentUser->getRecommendations());
        }
    }

    public function testCanFetchMomentsFeed()
    {
        $this->tinderClient->getMomentsFeed();
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser);

        $this->assertNotNull($currentUser->getMomentsFeed());
        $this->assertEquals(2, sizeof($currentUser->getMomentsFeed()));
    }

    public function testCanFetchMomentsLikes()
    {
        $this->tinderClient->getUsersMomentsLikes();
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser);

        $this->assertNotNull($currentUser->getMomentsLikes());
        $this->assertEquals(10, sizeof($currentUser->getMomentsLikes()));
    }

    public function testCanFetchAssets()
    {
        $this->tinderClient->requestAssets();
        $assets = $this->tinderClient->getAssets();

        $this->assertNotNull($assets);
        $this->assertNotNull($assets->getIntroductoryMoments());
    }

    public function testCanFetchMetadata()
    {
        $this->tinderClient->requestMetadata();
        $metadata = $this->tinderClient->getMetadata();

        $this->assertNotNull($metadata);
        /*$this->assertNotNull($metadata->getStatus());
        $this->assertNotNull($metadata->getNotifications());
        $this->assertNotNull($metadata->getGroups());
        $this->assertNotNull($metadata->getRating());
        $this->assertNotNull($metadata->getTravel());
        $this->assertNotNull($metadata->getPurchases());
        $this->assertNotNull($metadata->getVersions());
        $this->assertNotNull($metadata->getVersions()->getActiveText());
        $this->assertNotNull($metadata->getVersions()->getAgeFilter());
        $this->assertNotNull($metadata->getVersions()->getMatchmaker());
        $this->assertNotNull($metadata->getVersions()->getTrending());
        $this->assertNotNull($metadata->getVersions()->getTrendingActiveText());
        $this->assertNotNull($metadata->getGlobals());*/
    }

    public function testCanFetchUpdates()
    {
        $lastActivityDate = null;
        $updates = $this->tinderClient->getUpdates($lastActivityDate);
    }

    public function testCanFetchPersonsProfile()
    {
        $this->tinderClient->getAllExistingData();
        $currentUser = $this->tinderClient->getUser();
        $this->assertNotNull($currentUser);

        $matches = $currentUser->getMatches();
        $this->assertNotNull($matches);

        foreach($matches as $match)
        {
            $person = $this->tinderClient->getPerson($match->getIdentifier());
            $this->assertNotNull($person);
            $this->assertNotNull($person->getBio());
            $this->assertNotNull($person->getBirthDate());
            $this->assertNotNull($person->getName());
            $this->assertNotNull($person->getPingTime());
            $this->assertNotNull($person->getPhotos());
            //$this->assertNotNull($person->getMoments());
        }

    }

}
