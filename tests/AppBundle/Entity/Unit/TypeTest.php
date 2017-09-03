<?php


namespace Tests\AppBundle\Entity\Unit;


use AppBundle\Entity\Unit\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    public function testName()
    {
        $type = new Type();
        $this->assertNull($type->getName());

        $type->setName('Type');
        $this->assertNotNull($type->getName());
        $this->assertEquals('Type', $type->getName());
    }
}