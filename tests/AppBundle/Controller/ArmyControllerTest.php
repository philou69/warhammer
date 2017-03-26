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
        $crawler = $this->client->request('GET', '/army/list');

        $this->assertEquals('AppBundle\Controller\ArmyController::listAction', $this->client->getRequest()->attributes->get('_controller'));
        $this->assertEquals('4', $crawler->filter('a.armies')->count());

    }

    public function testwiew()
    {
        $crawler = $this->client->request('GET', '/army/armee-1');

        $this->assertEquals('AppBundle\Controller\ArmyController::viewAction', $this->client->getRequest()->attributes->get('_controller'));
        $this->assertEquals('
			armée 1 commandé par user1
		', $crawler->filter('h2')->text());
        $this->assertEquals('7', $crawler->filter('div.panel')->count());
    }
}