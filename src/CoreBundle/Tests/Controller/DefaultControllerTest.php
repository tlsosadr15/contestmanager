<?php

namespace CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testTournament()
    {
        $client = static::createClient();

        $client->request('GET', '/tournament');
    }

}
