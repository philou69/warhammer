<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 16/12/16
 * Time: 13:09
 */

namespace AppBundle\DataFixtures\ORM\Army;


use AppBundle\Entity\Army\PhotoFigurine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPhotoFigurineData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $photoFigurine = new PhotoFigurine();

        $photoFigurine->setUrl('5697dd1d82e6b.jpg')
            ->setAlt('photo armee')
            ->setFigurine($this->getReference('figurine-army-1'));

        $manager->persist($photoFigurine);
        $manager->flush();
    }

    public function getOrder()
    {
        return 13;
    }
}