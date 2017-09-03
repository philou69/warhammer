<?php

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

abstract class AbstractTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client = null;

    public function setUp()
    {
        $this->client = $this->createAuthorizedClient();
    }

    /**
     * @return Client
     */
    protected function createAuthorizedClient()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form();

        $form['_username'] = 'philou';
        $form['_password'] = 'test';

        $client->submit($form);

        return $client;
    }
}