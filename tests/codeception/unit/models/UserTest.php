<?php

namespace tests\codeception\unit\models;

use yii\codeception\TestCase;

class UserTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        // uncomment the following to load fixtures for user table
        //$this->loadFixtures(['user']);
    }
    public function test_something()
    {
        $this->assertEquals(1, 2);
    }

    // TODO add test methods here
}
