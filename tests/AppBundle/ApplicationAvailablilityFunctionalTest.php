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
            array('/'),
            array('/battles'),
            array('/battle/add'),
            array('/battle/edit/battle-futur'),
            array('/battle/battle-futur'),
            array('/battle/future/battle-futur'),
            array('/battle/add/view/battle-passee'),
            array('/battle/edit/view/1'),
            array('/battle/canceled/battle-passee'),
            array('/battle/delete/battle-passee'),
            array('/battle/photos/1'),
            array('/armies'),
            array('/armies/add'),
            array('/armies/army/armee-1'),
            array('/armies/edit/armee-2'),
            array('/armies/delete/armee-2'),
            array('/figurines/add/armee-1'),
            array('/figurines/edit/1'),
            array('/figurines/delete/1'),
            array('/photo/add/1'),
            array('/photo/delete/1'),
            array('/user/view'),
            array('/user/edit/1')
        );
    }

}