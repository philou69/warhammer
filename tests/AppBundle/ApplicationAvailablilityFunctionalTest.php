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
            array('/battle/list'),
//            array('/battle/create'),
            array('/battle/battle-futur/edit'),
            array('/battle/battle-futur'),
            array('/battle/future/battle-futur'),
            array('/resume/battle-passee/create'),
            array('/resume/1/edit'),
            array('/battle/battle-passee/canceled'),
            array('/battle/battle-passee/delete'),
            array('/photo/user/1'),
            array('/army/list'),
//            array('/army/create'),
            array('/army/armee-1'),
            array('/army/armee-2/edit'),
            array('/army/armee-2/delete'),
//            array('/figurine/armee-1/create'),
            array('/figurine/1/edit'),
            array('/figurine/1/delete'),
            array('/photo/user/1/add'),
            //array('/photo/user/1/delete'),
            array('/user/view'),
            array('/user/1/edit')
        );
    }

}