<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 13/12/16
 * Time: 16:11
 */

namespace AppBundle\DataFixtures\ORM\Army;


use AppBundle\Entity\Army\UnitArmy;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUnitArmyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $unitsArmeName = [
            [
                'unit' => $this->getReference('unit-1'),
                'army' => $this->getReference('army-1')
            ],
            [
                'unit' => $this->getReference('unit-2'),
                'army' => $this->getReference('army-2')
            ],
            [
                'unit' => $this->getReference('unit-2'),
                'army' => $this->getReference('army-1')
            ],
            [
                'unit' => $this->getReference('unit-3'),
                'army' => $this->getReference('army-1')
            ],
            [
                'unit' => $this->getReference('unit-4'),
                'army' => $this->getReference('army-1')
            ],
            [
                'unit' => $this->getReference('unit-5'),
                'army' => $this->getReference('army-1')
            ],
        ];

        $i = 0;
        foreach ($unitsArmeName as $unitArmeName) {
            $unitArme = new UnitArmy();
            $unitArme->setUnit($unitArmeName['unit'])
                ->setArmy($unitArmeName['army']);

            $manager->persist($unitArme);
            $manager->flush();

            $this->addReference('unit-army-'.$i, $unitArme);
            $i++;
        }

    }

    public function getOrder()
    {
        return 6;
    }
}