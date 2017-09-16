<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 23/12/16
 * Time: 15:27
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AbstractTest;

class ArmyControllerTest extends AbstractTest
{
    public function testIndex()
    {
        $crawler = $this->client->request('GET', $this->client->getContainer()->get('router')->generate('army_list'));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\ArmyController::listAction', $this->client->getRequest()->attributes->get('_controller'));

    }

    public function testCreate()
    {
        $crawler = $this->client->request('GET', $this->client->getContainer()->get('router')->generate('army_list'));

        $link = $crawler->selectLink('Créer une armée')->link();

        $crawler = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\ArmyController::createAction', $this->client->getRequest()->attributes->get('_controller'));

        $form = $crawler->selectButton('Enregistrer')->form();

        $form['army[name]'] = 'test';
        $form['army[race]'] = '29b6f2e9-70af-11e7-b20b-00224dab3d86';

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\ArmyController::viewAction', $this->client->getRequest()->attributes->get('_controller'));

        $this->assertContains('test commandé', $this->client->getResponse()->getContent());
        $this->assertContains("d'origine Orks", $this->client->getResponse()->getContent());
    }

    public function testview()
    {
        $crawler = $this->client->request('GET', $this->client->getContainer()->get('router')->generate('army_view', ['slug' => 'test']));

        $this->assertEquals('AppBundle\Controller\ArmyController::viewAction', $this->client->getRequest()->attributes->get('_controller'));
        $this->assertContains('test commandé par philou', $this->client->getResponse()->getContent());
        $this->assertContains('QG (0)', $this->client->getResponse()->getContent());
        $this->assertContains('Troupe (0)', $this->client->getResponse()->getContent());


    }

    public function testEdit()
    {
        $crawler = $this->client->request('GET', $this->client->getContainer()->get('router')->generate('army_view', ['slug' => 'test']));

        $link = $crawler->selectLink('Modifier')->link();

        $crawler = $this->client->click($link);
        $this->assertEquals('AppBundle\Controller\ArmyController::editAction', $this->client->getRequest()->get('_controller'));

        $form = $crawler->selectButton('Enregistrer')->form();

        $form['edit_army[name]'] = 'test2';

        $this->client->submit($form);
        $crawler = $this->client->followRedirect();

        $this->assertEquals('AppBundle\Controller\ArmyController::viewAction', $this->client->getRequest()->get('_controller'));

        $this->assertContains('test2 commandé par philou', $this->client->getResponse()->getContent());
    }
    public function testDelete()
    {
        $crawler = $this->client->request('GET', $this->client->getContainer()->get('router')->generate('army_view', ['slug' => 'test2']));

        $link = $crawler->selectLink('OUI')->link();

        $crawler = $this->client->click($link);
        $this->assertEquals('AppBundle\Controller\ArmyController::deleteAction', $this->client->getRequest()->get('_controller'));

    }

}