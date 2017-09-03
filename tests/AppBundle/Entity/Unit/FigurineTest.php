<?php


namespace Tests\AppBundle\Entity\Unit;


use AppBundle\Entity\Unit\Equipement;
use AppBundle\Entity\Unit\Figurine;
use AppBundle\Entity\Unit\Type;
use AppBundle\Entity\Unit\Unit;
use PHPUnit\Framework\TestCase;

class FigurineTest extends TestCase
{
    public function testName()
    {
        $figurine = new Figurine();

        $this->assertNull($figurine->getName());

        $figurine->setName('Figurine');
        $this->assertNotNull($figurine->getName());
        $this->assertEquals('Figurine', $figurine->getName());
    }

    public function testMinQuantity()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine');

        $this->assertNull($figurine->getMinQuantity());
        $figurine->setMinQuantity(1);
        $this->assertNotNull($figurine->getMinQuantity());
        $this->assertEquals(1, $figurine->getMinQuantity());
    }

    public function testMaxQuantity()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1);
        $this->assertNull($figurine->getMaxQuantity());
        $figurine->setMaxQuantity(2);
        $this->assertNotNull($figurine->getMaxQuantity());
        $this->assertEquals(2, $figurine->getMaxQuantity());
    }

    public function testMove()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2);
        $this->assertNull($figurine->getMove());
        $figurine->setMove(3);
        $this->assertNotNull($figurine->getMove());
        $this->assertEquals(3, $figurine->getMove());
    }

    public function testWeaponSkill()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3);
        $this->assertNull($figurine->getWeaponSkill());
        $figurine->setWeaponSkill(4);
        $this->assertNotNull($figurine->getWeaponSkill());
        $this->assertEquals(4, $figurine->getWeaponSkill());
    }

    public function testBalisticSkill()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4);
        $this->assertNull($figurine->getBalisticSkill());
        $figurine->setBalisticSkill(5);
        $this->assertNotNull($figurine->getBalisticSkill());
        $this->assertEquals(5, $figurine->getBalisticSkill());
    }

    public function testStrength()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5);
        $this->assertNull($figurine->getStrength());
        $figurine->setStrength(6);
        $this->assertNotNull($figurine->getStrength());
        $this->assertEquals(6, $figurine->getStrength());
    }

    public function testToughness()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6);
        $this->assertNull($figurine->getToughness());
        $figurine->setToughness(7);
        $this->assertNotNull($figurine->getToughness());
        $this->assertEquals(7, $figurine->getToughness());
    }

    public function testWounds()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7);
        $this->assertNull($figurine->getWounds());
        $figurine->setWounds(8);
        $this->assertNotNull($figurine->getWounds());
        $this->assertEquals(8, $figurine->getWounds());
    }

    public function testAttacks()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8);
        $this->assertNull($figurine->getAttacks());
        $figurine->setAttacks(9);
        $this->assertNotNull($figurine->getAttacks());
        $this->assertEquals(9, $figurine->getAttacks());
    }

    public function testLeaderShip()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8)
            ->setAttacks(9);
        $this->assertNull($figurine->getLeaderShip());
        $figurine->setLeaderShip(10);
        $this->assertNotNull($figurine->getLeaderShip());
        $this->assertEquals(10, $figurine->getLeaderShip());
    }

    public function testSave()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8)
            ->setAttacks(9)
            ->setLeaderShip(10);
        $this->assertNull($figurine->getSave());
        $figurine->setSave(11);
        $this->assertNotNull($figurine->getSave());
        $this->assertEquals(11, $figurine->getSave());
    }

    public function testPoints()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8)
            ->setAttacks(9)
            ->setLeaderShip(10)
            ->setSave(11);
        $this->assertNull($figurine->getPoints());
        $figurine->setPoints(12);
        $this->assertNotNull($figurine->getPoints());
        $this->assertEquals(12, $figurine->getPoints());
    }

    public function testType()
    {
        $figurine = new Figurine();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8)
            ->setAttacks(9)
            ->setLeaderShip(10)
            ->setSave(11)
            ->setPoints(12);
        $this->assertNull($figurine->getType());
        $type = new Type();
        $figurine->setType($type);
        $this->assertNotNull($figurine->getType());
        $this->assertEquals($type, $figurine->getType());
    }

    public function testUnit()
    {
        $figurine = new Figurine();
        $type = new Type();
        $unit = new Unit();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8)
            ->setAttacks(9)
            ->setLeaderShip(10)
            ->setSave(11)
            ->setPoints(12)
            ->setType($type);
        $this->assertNull($figurine->getUnit());
        $figurine->setUnit($unit);
        $this->assertNotNull($figurine->getUnit());
        $this->assertEquals($unit, $figurine->getUnit());
    }

    public function testEquipements()
    {
        $figurine = new Figurine();
        $type = new Type();
        $unit = new Unit();
        $figurine->setName('Figurine')
            ->setMinQuantity(1)
            ->setMaxQuantity(2)
            ->setMove(3)
            ->setWeaponSkill(4)
            ->setBalisticSkill(5)
            ->setStrength(6)
            ->setToughness(7)
            ->setWounds(8)
            ->setAttacks(9)
            ->setLeaderShip(10)
            ->setSave(11)
            ->setPoints(12)
            ->setType($type)
            ->setUnit($unit);
        $this->assertEquals(0, $figurine->getEquipements()->count());
        $equipementRemove = null;
        for ($i = 0; $i < 4 ; $i++)
        {
            $equipement = new Equipement();
            $figurine->addEquipement($equipement);
            $equipementRemove = $equipement;
        }
        $this->assertNotNull($figurine->getEquipements()->count());
        $this->assertEquals(4, $figurine->getEquipements()->count());
        $figurine->removeEquipement($equipementRemove);
        $this->assertEquals(3, $figurine->getEquipements()->count());
    }
}