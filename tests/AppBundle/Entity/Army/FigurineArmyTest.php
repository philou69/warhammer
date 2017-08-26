<?php


namespace Tests\AppBundle\Entity\Army;


use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Entity\Army\UnitArmy;
use AppBundle\Entity\Unit\Equipement;
use AppBundle\Entity\Unit\Figurine;
use PHPUnit\Framework\TestCase;

class FigurineArmyTest extends TestCase
{
    public function testFigurine()
    {
        $figurineArmy = new FigurineArmy();
        $figurine = new Figurine();
        $this->assertNull($figurineArmy->getFigurine());
        $figurineArmy->setFigurine($figurine);
        $this->assertNotNull($figurineArmy->getFigurine());
        $this->assertInstanceOf(get_class($figurine), $figurineArmy->getFigurine());
        $this->assertEquals($figurine, $figurineArmy->getFigurine());
    }

    public function testUnit()
    {
        $figurineArmy = new FigurineArmy();
        $figurine = new Figurine();
        $figurineArmy->setFigurine($figurine);
        $unitArmy = new UnitArmy();

        $this->assertNull($figurineArmy->getUnit());
        $figurineArmy->setUnit($unitArmy);
        $this->assertNotNull($figurineArmy->getUnit());
        $this->assertInstanceOf(get_class($unitArmy), $figurineArmy->getUnit());
        $this->assertEquals($unitArmy, $figurineArmy->getUnit());
    }

    public function testEquipements()
    {
        $figurineArmy = new FigurineArmy();
        $figurine = new Figurine();
        $unitArmy = new UnitArmy();
        $figurineArmy->setFigurine($figurine)
            ->setUnit($unitArmy);

        $this->assertEquals(0,$figurineArmy->getEquipements()->count());
        $equipementRemove = null;
        for ($i = 0; $i < 4; $i++) {
            $equipement = new Equipement();
            $equipement->setPoints(10);
            $figurineArmy->addEquipement($equipement);
            if($i === 1){
                $equipementRemove = $equipement;
            }
        }
        $this->assertEquals(4, $figurineArmy->getEquipements()->count());
        $this->assertInstanceOf(get_class($equipementRemove), $figurineArmy->getEquipements()->first());
        $figurineArmy->removeEquipement($equipementRemove);
        $this->assertEquals(3, $figurineArmy->getEquipements()->count());
    }

    public function testPoints()
    {
        $figurineArmy = new FigurineArmy();
        $figurine = new Figurine();
        $figurine->setPoints(10);
        $unitArmy = new UnitArmy();
        $figurineArmy->setFigurine($figurine)
            ->setUnit($unitArmy)
            ->setQuantity(4);
        $this->assertEquals(40, $figurineArmy->getPoints());
        $equipementRemove = null;
        for ($i = 0; $i < 4; $i++) {
            $equipement = new Equipement();
            $equipement->setPoints(10);
            $figurineArmy->addEquipement($equipement);
            if($i === 1){
                $equipementRemove = $equipement;
            }
        }
        $this->assertEquals(((4 * 10 ) + (4 * (4 *10))), $figurineArmy->getPoints());
    }

    public function testQuantity()
    {
        $figurineArmy = new FigurineArmy();
        $figurine = new Figurine();
        $figurine->setPoints(10);
        $this->assertNull($figurineArmy->getQuantity());
        $unitArmy = new UnitArmy();
        $figurineArmy->setFigurine($figurine)
            ->setUnit($unitArmy)
            ->setQuantity(4);
        for ($i = 0; $i < 4; $i++) {
            $equipement = new Equipement();
            $equipement->setPoints(10);
            $figurineArmy->addEquipement($equipement);
        }
        $this->assertNotNull($figurineArmy->getQuantity());
        $this->assertEquals(4, $figurineArmy->getQuantity());
    }
}