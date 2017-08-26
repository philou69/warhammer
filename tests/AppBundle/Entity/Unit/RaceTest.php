<?php


namespace Tests\AppBundle\Entity\Unit;


use AppBundle\Entity\Unit\Race;
use AppBundle\Entity\Unit\Unit;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public function testName()
    {
        $race = new Race();
        $this->assertNull($race->getName());
        $race->setName('Race');
        $this->assertNotNull($race->getName());
        $this->assertEquals('Race', $race->getName());
    }

    public function testUnits()
    {

        $race = new Race();
        $race->setName('Race');
        $this->assertEquals(0, $race->getUnits()->count());
        $unitRemove;
        for ($i =0; $i < 4 ; $i++)
        {
            $unit = new Unit();
            $race->addUnit($unit);
            if($i === 1){
                $unitRemove = $unit;
            }
        }

        $this->assertEquals(4, $race->getUnits()->count());

        $race->removeUnit($unitRemove);
        $this->assertEquals(3, $race->getUnits()->count());
    }
}