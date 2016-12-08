<?php

namespace SchoolBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    /**
     * Test create news
     *
     * @return null
     */
    public function testList()
    {
        $client = static::createClient();
        $client->request('GET', '/school/list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
