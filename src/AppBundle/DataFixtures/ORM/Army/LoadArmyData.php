<?php

namespace AppBundle\DataFixtures\ORM\Army;

use AppBundle\Entity\Army\Army;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadArmyData extends AbstractFixture  implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $armiesName = [
            [
                'name' => 'armée 1',
                'race' => $this->getReference('race-1'),
                'user' => $this->getReference('user-1')
            ],
            [
                'name' => 'armée 2',
                'race' => $this->getReference('race-2'),
                'user' => $this->getReference('user-1')
            ],
            [
                'name' => 'armée 3',
                'race' => $this->getReference('race-3'),
                'user' => $this->getReference('user-2')
            ],
        ];
        $i = 1;
        foreach ($armiesName as $armyName) {
            $army = new Army();
            $army->setRace($armyName['race'])
                ->setUser($armyName['user'])
                ->setName($armyName['name']);

            $manager->persist($army);
            $manager->flush();
            $this->addReference('army-'.$i, $army);
            $i++;
        }

    }

    public function getOrder()
    {
        return 3;
    }
}