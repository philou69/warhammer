<?php
namespace AppBundle\DataFixtures\ORM\Army;

use AppBundle\Entity\Army\Groupe;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $groupesName = [
            'QG',
            'Troupes',
            'Elites',
            'Transport',
            'Rapide',
            'Soutien',
            'Seigneur de Guerre'
        ];

        $i = 1;
        foreach ($groupesName as $groupeName) {
            $groupe = new Groupe();
            $groupe->setName($groupeName);

            $manager->persist($groupe);
            $manager->flush();

            $this->addReference('groupe-'.$i, $groupe);
            $i++;
        }

    }

    public function getOrder()
    {
        return 4;
    }
}