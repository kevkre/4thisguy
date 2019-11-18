<?php

use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{

    private $connection;

    public function setUp():void
    {

        include_once("./config/connect_db_unit_tests.php");

        $this->connection = get_connection($this->connection);

    }

    /**@test */
    public function test_Connection()
    {

        $statement = $this->connection->prepare("SELECT titel FROM film;");
        $statement->execute();
        $ergebnis = $statement->fetchAll();
        $this->assertEquals("Angry Birds 2", $ergebnis[0][0]);

    }

}