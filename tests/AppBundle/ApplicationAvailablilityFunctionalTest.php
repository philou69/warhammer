<?php

namespace Tests\AppBundle;

use Tests\AppBundle\AbstractTest;

class ApplicationAvailabilityFunctionalTest extends AbstractTest
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $crawler = $this->client->request('GET', $url);

        $this->assertTrue($this->client->getResponse()->isSuccessful());

    }

    public function urlProvider()
    {
        return array(
            array('/')
        );
    }

}