<?php
namespace AppBundle\DataFixtures\ORM\Army;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Army\Race;

class LoadRaceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $racesName = [
            'Dark Angel',
            'Orks',
            'Tyrannides',
        ];
        $i = 1;
        foreach ($racesName as $raceName) {
            $race = new Race();
            $race->setName($raceName);

            $manager->persist($race);
            $manager->flush();

            $this->addReference('race-' . $i, $race);
            $i++;
        }

    }

    public function getOrder()
    {
        return 2;
    }
}