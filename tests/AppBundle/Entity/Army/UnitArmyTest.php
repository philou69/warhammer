<?php


namespace Tests\AppBundle\Entity\Army;


use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Entity\Army\PictureUnit;
use AppBundle\Entity\Army\UnitArmy;
use AppBundle\Entity\Unit\Figurine;
use AppBundle\Entity\Unit\Unit;
use PHPUnit\Framework\TestCase;

class UnitArmyTest extends TestCase
{
    public function testUnit()
    {
        $unitArmy = new UnitArmy();
        $unit = new Unit();
        $this->assertNull($unitArmy->getUnit());
        $unitArmy->setUnit($unit);
        $this->assertNotNull($unitArmy->getUnit());
        $this->assertInstanceOf(get_class($unit), $unitArmy->getUnit());
        $this->assertEquals($unit, $unitArmy->getUnit());
    }

    public function testArmy()
    {
        $unitArmy = new UnitArmy();
        $unit = new Unit();
        $army = new Army();
        $unitArmy->setUnit($unit);
        $this->assertNull($unitArmy->getArmy());
        $unitArmy->setArmy($army);
        $this->assertNotNull($unitArmy->getArmy());
        $this->assertInstanceOf(get_class($army), $unitArmy->getArmy());
        $this->assertEquals($army, $unitArmy->getArmy());
    }

    public function testFigurines()
    {
        $unitArmy = new UnitArmy();
        $unit = new Unit();
        $army = new Army();
        $figurineArmyRemove = null;
        $unitArmy->setUnit($unit)
            ->setArmy
            ($army);
        $this->assertEquals(0,$unitArmy->getFigurines()->count());
        for ($i = 0; $i < 4; $i++)
        {
            $figurineArmy = new FigurineArmy();
            $figurine = new Figurine();
            $figurine->setPoints(10);
            $figurineArmy->setFigurine($figurine)
                ->setQuantity(4);
            $unitArmy->addFigurine($figurineArmy);
            if($i === 1){
                $figurineArmyRemove = $figurineArmy;
            }
        }
        $this->assertEquals(4, $unitArmy->getFigurines()->count());
        $this->assertInstanceOf(get_class($figurineArmyRemove), $unitArmy->getFigurines()->first());
        $unitArmy->removeFigurine($figurineArmyRemove);
        $this->assertEquals(3, $unitArmy->getFigurines()->count());
    }

    public function testPoints()
    {
        $unitArmy = new UnitArmy();
        $unit = new Unit();
        $army = new Army();
        $figurineArmyRemove = null;
        $unitArmy->setUnit($unit)
            ->setArmy
            ($army);
        $this->assertEquals(0,$unitArmy->getPoints());
        for ($i = 0; $i < 4; $i++)
        {
            $figurineArmy = new FigurineArmy();
            $figurine = new Figurine();
            $figurine->setPoints(10);
            $figurineArmy->setFigurine($figurine)
                ->setQuantity(4);
            $unitArmy->addFigurine($figurineArmy);
            if($i === 1){
                $figurineArmyRemove = $figurineArmy;
            }
        }
        $this->assertEquals((4 * (4*10)), $unitArmy->getPoints());
        $unitArmy->removeFigurine($figurineArmy);
        $this->assertEquals((3*(4*10)), $unitArmy->getPoints());
    }

    public function testPicture()
    {
        $unitArmy = new UnitArmy();
        $unit = new Unit();
        $army = new Army();
        $figurineArmyRemove = null;
        $unitArmy->setUnit($unit)
            ->setArmy
            ($army);
        for ($i = 0; $i < 4; $i++)
        {
            $figurineArmy = new FigurineArmy();
            $figurine = new Figurine();
            $figurine->setPoints(10);
            $figurineArmy->setFigurine($figurine)
                ->setQuantity(4);
            $unitArmy->addFigurine($figurineArmy);
            if($i === 1){
                $figurineArmyRemove = $figurineArmy;
            }
        }
        $this->assertNull($unitArmy->getPicture());
        $picture = new PictureUnit();
        $unitArmy->setPicture($picture);
        $this->assertEquals($picture, $unitArmy->getPicture());
        $this->assertNotNull($unitArmy->getPicture());
        $this->assertInstanceOf(get_class($picture), $unitArmy->getPicture());
    }
}