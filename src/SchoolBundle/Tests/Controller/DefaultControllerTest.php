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
        $client->request('GET', '/school/school/list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    /**
     * Test create news
     *
     * @return null
     */
//    public function testCreate()
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/school/school/create');
//        $this->assertEquals(302, $client->getResponse()->getStatusCode());
//        $this->assertContains('Create', $crawler->filter('title')->text());
//
//        $action = $crawler->filter('div.sonata-ba-form form')->attr('action');
//        $formId = explode('=', $action)[1];
//
//        $form = $crawler->selectButton('btn_create_and_list')->form();
//
//        $form->setValues(array(
//            $formId => array(
//                'name' => 'A school',
//            ),
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        $this->assertContains('Item "A school" has been successfully created.', $crawler->filter('div.alert-success')->text());
//    }
}
