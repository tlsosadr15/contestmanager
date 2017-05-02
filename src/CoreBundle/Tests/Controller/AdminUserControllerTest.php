<?php
/**
 * AdminUserControllerTest class file
 *
 * PHP Version 7
 *
 * @category Test
 * @package  CoreBundle\Tests\Controller
 * @author   @author Guillaume <contact@guillaume-torres.fr>
 * @license  All right reserved
 * @link     Null
 */
namespace CoreBundle\Tests\Controller;

use CoreBundle\Tests\BaseTest;
use UserBundle\Entity\User;

/**
 * AdminUserControllerTest class
 *
 * @category Test
 * @package  CoreBundle\Tests\Controller
 * @author   @author Guillaume <contact@guillaume-torres.fr>
 * @license  All right reserved
 * @link     Null
 */
class AdminUserControllerTest extends BaseTest
{
    /**
     * Test user list
     *
     * @return null
     */
    public function testIndex()
    {
        $crawler = $this->client->request('GET', $this->getRouter()->generate('admin_user_user_list'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Admin', $crawler->filter('title')->text());
    }

    /**
     * Test user creation
     *
     * @return null
     */
    public function testUserCreate()
    {
        $crawler = $this->client->request('GET', $this->getRouter()->generate('admin_user_user_create'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $action = $crawler->filter('div.sonata-ba-form form')->attr('action');
        $formId = explode('=', $action)[1];

        $form = $crawler->selectButton('btn_create_and_edit')->form();
        $form->setValues(
            array(
                $formId => array(
                  'username' => 'john_smith',
                  'firstName' => 'John',
                  'lastName' => 'Smith',
                  'email' => 'john.smith@gmail.com',
                  'plainPassword' => 'password',
                ),
            )
        );
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('L\'élément "john_smith" a été créé avec succès.', $crawler->filter('div.alert-success')->text());
    }

    /**
     * Test user edition
     *
     * @return null
     */
    public function testUserEdit()
    {
        /** @var User $user */
        $user = $this->fixtures->getReference('teacher0');

        $crawler = $this->client->request('GET', $this->getRouter()->generate(
            'admin_user_user_edit',
            ['id' => $user->getId()]
        ));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $action = $crawler->filter('div.sonata-ba-form form')->attr('action');
        $formId = explode('=', $action)[1];

        $form = $crawler->selectButton('btn_update_and_list')->form();
        $form->setValues(array($formId => array('username' => 'Toto', 'email' => 'toto@gmail.com')));
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('L\'élément "Toto" a été mis à jour avec succès.', $crawler->filter('div.alert-success')->text());
    }

    /**
     * Test user deletion
     *
     * @return null
     */
    public function testUserDelete()
    {
        /** @var User $user */
        $user = $this->fixtures->getReference('teacher0');

        $crawler = $this->client->request('GET', $this->getRouter()->generate(
            'admin_user_user_delete',
            ['id' => $user->getId()]
        ));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Êtes-vous sûr de vouloir supprimer l\'élément "'.$user->getUsername().'" sélectionné?', $crawler->filter('div.box-body')->text());

        $form = $crawler->filter('button:contains("supprimer")')->eq(0)->form();
        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('L\'élément "'.$user->getUsername().'" a été supprimé avec succès.', $crawler->filter('div.alert-success')->text());
    }
}
