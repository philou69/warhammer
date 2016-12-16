<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 13/12/16
 * Time: 16:20
 */

namespace AppBundle\DataFixtures\ORM\Army;


use AppBundle\Entity\Army\Equipement;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEquipementData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $equipementsName = [
            [
                'name' => 'Arme Energetique',
                'points' => '15'
            ],
            [
                'name' => 'Bolter',
                'points' => '0'
            ],
            [
                'name' => 'Autocanon Jumelé',
                'points' => '5'
            ],
            [
                'name' => 'Canon à Plasma *2',
                'points' => '10'
            ],
            [
                'name' => 'Bolter d\'Assaut',
                'points' => '5'
            ],
            [
                'name' => 'Extra Armour',
                'points' => '10'
            ]
        ];
        $i = 1;
        foreach ($equipementsName as $equipementName) {
            $equipement = new Equipement();
            $equipement->setName($equipementName['name'])
                ->setPoints($equipementName['points']);

            $manager->persist($equipement);
            $manager->flush();

            $this->addReference('equipement-'.$i, $equipement);
            $i++;
        }

    }

    public function getOrder()
    {
        return 7;
    }
}