<?php

namespace Tests\AppBundle\Entity\Army;

use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Entity\Army\UnitArmy;
use AppBundle\Entity\Unit\Figurine;
use AppBundle\Entity\Unit\Race;
use AppBundle\Entity\User\User;
use PHPUnit\Framework\TestCase;

class ArmyTest extends TestCase
{
    public function testName()
    {
        $army = new Army();
        $this->assertNull($army->getName());
        $army->setName('Army');
        $this->assertNotNull($army->getName());
        $this->assertEquals('Army', $army->getName());
    }

    public function testRace()
    {
        $army = new Army();
        $race = new Race();
        $army->setName('Army');
        $this->assertNull($army->getRace());
        $army->setRace($race);
        $this->assertNotNull($army->getRace());
        $this->assertInstanceOf(get_class($race), $army->getRace());
        $this->assertEquals($race, $army->getRace());
    }

    public function testUser()
    {
        $army = new Army();
        $race = new Race();
        $user = new User();
        $army->setName('Army')
            ->setRace($race);
        $this->assertNull($army->getUser());
        $army->setUser($user);
        $this->assertNotNull($army->getUser());
        $this->assertInstanceOf(get_class($user), $army->getUser());
        $this->assertEquals($user, $army->getUser());
    }

    public function testUnits()
    {
        $army = new Army();
        $race = new Race();
        $user = new User();
        $army->setName('Army')
            ->setRace($race)
            ->setUser($user);
        $this->assertEquals(0, $army->getUnits()->count());
        $unitArmyRemove = null;
        for( $i = 0; $i < 4 ; $i++)
        {
            $unitArmy = new UnitArmy();
            $figurineArmy = new FigurineArmy();
            $figurine = new Figurine();
            $figurine->setPoints(10);
            $figurineArmy->setFigurine($figurine)
                ->setQuantity(4);
            $unitArmy->addFigurine($figurineArmy);
            $army->addUnit($unitArmy);
            if($i === 1)
            {
                $unitArmyRemove = $unitArmy;
            }
        }
        $this->assertEquals(4, $army->getUnits()->count());
        $this->assertInstanceOf(get_class($unitArmyRemove), $army->getUnits()->first());
        $army->removeUnit($unitArmyRemove);
        $this->assertEquals(3, $army->getUnits()->count());
    }

    public function testPoints()
    {
        $army = new Army();
        $race = new Race();
        $user = new User();
        $army->setName('Army')
            ->setRace($race)
            ->setUser($user);
        $this->assertEquals(0, $army->getPoints());
        $unitArmyRemove = null;
        for( $i = 0; $i < 4 ; $i++)
        {
            $unitArmy = new UnitArmy();
            $figurineArmy = new FigurineArmy();
            $figurine = new Figurine();
            $figurine->setPoints(10);
            $figurineArmy->setFigurine($figurine)
                ->setQuantity(4);
            $unitArmy->addFigurine($figurineArmy);
            $army->addUnit($unitArmy);
            if($i === 1)
            {
                $unitArmyRemove = $unitArmy;
            }
        }
        $this->assertEquals((4 * (4*10)), $army->getPoints());
        $army->removeUnit($unitArmyRemove);
        $this->assertEquals((3 * (4*10)), $army->getPoints());
    }
}