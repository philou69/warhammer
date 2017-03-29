<?php


namespace AppBundle\DataFixtures\ORM\Battle;


use AppBundle\Entity\Battle\PhotoBattle;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;

class LoadPhotoBattleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $photoBattle = new PhotoBattle();

        $photoBattle->setUser($this->getReference('user-1'));
        $photoBattle->setUrl('3599565879+56.png');
        $photoBattle->setAlt('test photo');
        $photoBattle->setDateUpload(new \DateTime());

        $manager->persist($photoBattle);
        $manager->flush();
    }

    public function getOrder()
    {
        return 14;
    }
}