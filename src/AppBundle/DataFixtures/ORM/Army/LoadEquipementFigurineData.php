<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 13/12/16
 * Time: 16:24
 */

namespace AppBundle\DataFixtures\ORM\Army;


use AppBundle\Entity\Army\EquipementFigurine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEquipementFigurineData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $equipementFigurinesName  = [
            [
                'figurine' => $this->getReference('figurine-1'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-1'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-1'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-2'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-2'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-2'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-3'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-3'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-3'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-4'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-4'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-4'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-5'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-5'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-5'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-6'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-6'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-6'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-7'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-7'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-7'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-8'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-8'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-8'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-9'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-9'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-9'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-10'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-10'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-10'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-11'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-11'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-11'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-12'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-12'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-12'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-13'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-13'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-13'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-14'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-14'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-14'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-15'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-15'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-15'),
                'equipement' => $this->getReference('equipement-3')
            ],
            [
                'figurine' => $this->getReference('figurine-16'),
                'equipement' => $this->getReference('equipement-1')
            ],
            [
                'figurine' => $this->getReference('figurine-16'),
                'equipement' => $this->getReference('equipement-2')
            ],
            [
                'figurine' => $this->getReference('figurine-16'),
                'equipement' => $this->getReference('equipement-3')
            ],
        ];
        $i = 0;
        foreach ($equipementFigurinesName as $equipementFigureName) {
            $equipementFigurine = new EquipementFigurine();
            $equipementFigurine->setFigurine($equipementFigureName['figurine'])
                ->getEquipement($equipementFigureName['equipement']);

            $manager->persist($equipementFigurine);
            $manager->flush();

            $this->addReference('equipement-figurine-'.$i,  $equipementFigurine);
            $i++;
        }

    }

    public function getOrder()
    {
        return  8;
    }
}