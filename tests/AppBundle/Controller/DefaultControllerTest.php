<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\AbstractTest;

class DefaultControllerTest extends AbstractTest
{
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/battle/future/battle-futur');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
