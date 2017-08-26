<?php


namespace Tests\AppBundle\Entity\Unit;


use AppBundle\Entity\Unit\Equipement;
use AppBundle\Entity\Unit\Figurine;
use PHPUnit\Framework\TestCase;

class EquipementTest extends TestCase
{
    public function testName()
    {
        $equipement = new Equipement();
        $this->assertNull($equipement->getName());
        $equipement->setName('Equipement');
        $this->assertNotNull($equipement->getName());
        $this->assertEquals('Equipement', $equipement->getName());
    }

    public function testPoints()
    {
        $equipement = new Equipement();
        $equipement->setName('Equipement');
        $this->assertNull($equipement->getPoints());
        $equipement->setPoints(1);
        $this->assertNotNull($equipement->getPoints());
        $this->assertEquals(1, $equipement->getPoints());
    }

    public function testFigurine()
    {
        $equipement = new Equipement();
        $equipement->setName('Equipement')
            ->setPoints(1);
        $this->assertNull($equipement->getFigurine());
        $figurine = new Figurine();
        $equipement->setFigurine($figurine);
        $this->assertNotNull($equipement->getFigurine());
        $this->assertEquals($figurine, $equipement->getFigurine());
    }
}