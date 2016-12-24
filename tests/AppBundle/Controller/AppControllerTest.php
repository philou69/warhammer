<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 23/12/16
 * Time: 11:48
 */

namespace Tests\AppBundle\Controller;


use Tests\AppBundle\AbstractTest;

class AppControllerTest extends AbstractTest
{
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals('AppBundle\Controller\AppController::indexAction', $this->client->getRequest()->attributes->get('_controller'));
        $this->assertEquals('Bienvenue sur WarhantmilleBattle', $crawler->filter('h2')->text());
    }
}