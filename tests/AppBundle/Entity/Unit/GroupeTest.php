<?php


namespace Tests\AppBundle\Entity\Unit;


use AppBundle\Entity\Unit\Groupe;
use PHPUnit\Framework\TestCase;

class GroupeTest extends TestCase
{
    public function testName()
    {
        $groupe = new Groupe();
        $this->assertNull($groupe->getName());
        $groupe->setName('Groupe');
        $this->assertNotNull($groupe->getName());
        $this->assertEquals('Groupe', $groupe->getName());
    }
}