<?php


namespace Tests\AppBundle\Entity\Unit;


use AppBundle\Entity\Unit\Figurine;
use AppBundle\Entity\Unit\Groupe;
use AppBundle\Entity\Unit\Race;
use AppBundle\Entity\Unit\Unit;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testName()
    {
        $unit = new Unit();

        $this->assertNull($unit->getName());

        $unit->setName('unit');

        $this->assertEquals('unit', $unit->getName());
    }

    public function testRace()
    {
        $unit = new Unit();
        $unit->setName('unit');
        $this->assertNull($unit->getRace());
        $race = new Race();
        $unit->setRace($race);
        $this->assertNotNull($unit->getRace());
        $this->assertEquals($race, $unit->getRace());
    }

    public function testGroupe()
    {
        $unit = new Unit();
        $unit->setName('unit');
        $race = new Race();
        $unit->setRace($race);
        $this->assertNull($unit->getGroupe());
        $groupe = new Groupe();
        $unit->setGroupe($groupe);
        $this->assertNotNull($unit->getGroupe());
        $this->assertEquals($groupe, $unit->getGroupe());
    }

    public function testFigurines()
    {
        $unit = new Unit();
        $unit->setName('unit');
        $race = new Race();
        $unit->setRace($race);
        $groupe = new Groupe();
        $unit->setGroupe($groupe);
        $this->assertEquals(0,$unit->getFigurines()->count());
        $figurineRemove = null;
        for ($i=0; $i < 4; $i++)
        {
            $figurine = new Figurine();
            $unit->addFigurine($figurine);
            if ($i === 1){
                $figurineRemove = $figurine;
            }
        }
        $this->assertNotNull($unit->getFigurines());
        $this->assertEquals(4, $unit->getFigurines()->count());

        $unit->removeFigurine($figurineRemove);
        $this->assertEquals(3, $unit->getFigurines()->count());
    }
}