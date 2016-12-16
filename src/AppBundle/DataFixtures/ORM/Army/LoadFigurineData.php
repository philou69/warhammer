<?php
namespace AppBundle\DataFixtures\ORM\Army;

use AppBundle\Entity\Army\Figurine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFigurineData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $figurinesName = [
            [
                'name' => 'Azrael',
                'points' => '215',
                'groupe' => $this->getReference('groupe-1'),
                'race' => $this->getReference('race-1')
            ],
            [
                'name' => 'Escouade Tactique',
                'points' => '70',
                'groupe' => $this->getReference('groupe-2'),
                'race' => $this->getReference('race-1')
            ],
            [
                'name' => 'Dreadnought',
                'points' => '100',
                'groupe' => $this->getReference('groupe-3'),
                'race' => $this->getReference('race-1')
            ],
            [
                'name' => 'Rhino',
                'points' => '35',
                'groupe' => $this->getReference('groupe-4'),
                'race' => $this->getReference('race-1')
            ],
            [
                'name' => 'Escouade d\'assaut',
                'points' => '70',
                'groupe' => $this->getReference('groupe-5'),
                'race' => $this->getReference('race-1')
            ],
            [
                'name' => 'Predator',
                'points' => '75',
                'groupe' => $this->getReference('groupe-6'),
                'race' => $this->getReference('race-1')
            ],
            [
                'name' => 'Big Boss',
                'points' => '60',
                'groupe' => $this->getReference('groupe-1'),
                'race' => $this->getReference('race-2')
            ],
            [
                'name' => 'Bande de Boys',
                'points' => '60',
                'groupe' => $this->getReference('groupe-2'),
                'race' => $this->getReference('race-2')
            ],
            [
                'name' => 'Kasseurs de Tank',
                'points' => '65',
                'groupe' => $this->getReference('groupe-3'),
                'race' => $this->getReference('race-2')
            ],
            [
                'name' => 'Trukk',
                'points' => '30',
                'groupe' => $this->getReference('groupe-4'),
                'race' => $this->getReference('race-2')
            ],
            [
                'name' => 'Blitza Bomber',
                'points' => '135',
                'groupe' => $this->getReference('groupe-5'),
                'race' => $this->getReference('race-2')
            ],
            [
                'name' => 'Tank Volée',
                'points' => '37',
                'groupe' => $this->getReference('groupe-6'),
                'race' => $this->getReference('race-2')
            ],
            [
                'name' => 'Tyran des Ruches',
                'points' => '165',
                'groupe' => $this->getReference('groupe-1'),
                'race' => $this->getReference('race-3')
            ],
            [
                'name' => 'Essaim de Genovores',
                'points' => '70',
                'groupe' => $this->getReference('groupe-2'),
                'race' => $this->getReference('race-3')
            ],
            [
                'name' => 'Lictors',
                'points' => '55',
                'groupe' => $this->getReference('groupe-3'),
                'race' => $this->getReference('race-3')
            ],
            [
                'name' => 'Harpie',
                'points' => '135',
                'groupe' => $this->getReference('groupe-5'),
                'race' => $this->getReference('race-3')
            ],
        ];

        $i = 1;
        foreach ($figurinesName as $figureName) {
            $figurine = new Figurine();

            $figurine->setName($figureName['name'])
                ->setPoints($figureName['points'])
                ->setGroupe($figureName['groupe'])
                ->setRace($figureName['race'])
            ;
            $manager->persist($figurine);
            $manager->flush();

            $this->addReference('figurine-'.$i, $figurine);
            $i++;
        }


    }

    public function getOrder()
    {
        return 5;
    }
}