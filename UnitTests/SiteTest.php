<?php

use PHPUnit\Framework\TestCase;

class SiteTest extends TestCase
{

    private $site;

    public function setUp(): void 
    {

        //include_once("./components/Klassen/Site.php");

        $this->site = new Site("Start");
    }

    /**@test */
    public function testGetpage()
    {
        $page = $this->site->getpage();

        $this->assertEquals("Start", $page);

    }

    /**@test */
    public function file_does_not_exist()
    {
        $test = new Site("test");
        
        $page = $test->getpage();

        $this->assertEquals("404", $page);
    }

    /**@test */
    public function test_sitename()
    {
        $sitename = $this->site->sitename();

        $this->assertEquals("Home", $sitename);
    }

    /**@test */
    public function test_get_title()
    {

        include_once("./config/main_config.php");

        $title = $this->site->gettitle();

        $this->assertEquals("FlyCinema - Himmlische Unterhaltung | Home", $title);

    }
}
