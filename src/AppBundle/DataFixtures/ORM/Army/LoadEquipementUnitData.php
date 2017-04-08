<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 13/12/16
 * Time: 16:24
 */

namespace AppBundle\DataFixtures\ORM\Army;


use AppBundle\Entity\Army\EquipementUnit;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEquipementUnitData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $equipementUnitsName  = [
            [
                'unit' => $this->getReference('unit-1'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-1'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-1'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-2'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-2'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-2'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-3'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-3'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-3'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-4'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-4'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-4'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-5'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-5'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-5'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-6'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-6'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-6'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-7'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-7'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-7'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-8'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-8'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-8'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-9'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-9'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-9'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-10'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-10'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-10'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-11'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-11'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-11'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-12'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-12'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-12'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-13'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-13'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-13'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-14'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-14'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-14'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-15'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-15'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-15'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'unit' => $this->getReference('unit-16'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'unit' => $this->getReference('unit-16'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'unit' => $this->getReference('unit-16'),
                'equipement' => $this->getReference('equipement-3')
            ],
        ];
        $i = 0;
        foreach ($equipementUnitsName as $equipementUnitName) {
            $equipementUnit = new EquipementUnit();
            $equipementUnit->setUnit($equipementUnitName['unit'])
                ->getEquipement($equipementUnitName['equipement']);

            $manager->persist($equipementUnit);
            $manager->flush();

            $this->addReference('equipement-unit-'.$i,  $equipementUnit);
            $i++;
        }

    }

    public function getOrder()
    {
        return  8;
    }
}