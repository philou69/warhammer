<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 13/12/16
 * Time: 16:11
 */

namespace AppBundle\DataFixtures\ORM\Army;


use AppBundle\Entity\Army\FigurineArmy;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFigurineArmyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $figurinesArmeName = [
            [
                'figurine' => $this->getReference('figurine-1'),
                'army' => $this->getReference('army-1')
            ],
            [
                'figurine' => $this->getReference('figurine-2'),
                'army' => $this->getReference('army-2')
            ],
            [
                'figurine' => $this->getReference('figurine-2'),
                'army' => $this->getReference('army-1')
            ],
            [
                'figurine' => $this->getReference('figurine-3'),
                'army' => $this->getReference('army-1')
            ],
            [
                'figurine' => $this->getReference('figurine-4'),
                'army' => $this->getReference('army-1')
            ],
            [
                'figurine' => $this->getReference('figurine-5'),
                'army' => $this->getReference('army-1')
            ],
        ];

        $i = 0;
        foreach ($figurinesArmeName as $figurineArmeName) {
            $figurineArme = new FigurineArmy();
            $figurineArme->setFigurine($figurineArmeName['figurine'])
                ->setArmy($figurineArmeName['army']);

            $manager->persist($figurineArme);
            $manager->flush();

            $this->addReference('figurine-army-'.$i, $figurineArme);
            $i++;
        }

    }

    public function getOrder()
    {
        return 6;
    }
}