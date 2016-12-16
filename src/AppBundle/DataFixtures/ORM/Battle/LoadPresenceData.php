<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 16/12/16
 * Time: 11:14
 */

namespace AppBundle\DataFixtures\ORM\Battle;


use AppBundle\Entity\Battle\Presence;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPresenceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $presencesName = [
            'serez présent',
            'ne serez pas présent',
            'participerez au combat',
            'n\'avez pas répondu '
        ];
        $i = 1;
        foreach ($presencesName as $presenceName) {
            $presence = new Presence();

            $presence->setPresence($presenceName);
            $manager->persist($presence);
            $manager->flush();

            $this->addReference('presence-'.$i, $presence);
            $i++;
        }
    }

    public function getOrder()
    {
        return 10;
    }
}