<?php
namespace AppBundle\DataFixtures\ORM\Battle;


use AppBundle\Entity\Battle\Battle;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBattleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $date = new  \DateTime();
        $datefuture = $date->add(new \DateInterval('P2D'));

        $battleFutur = new Battle();
        $battleFutur->setName('battle futur')
                ->setCreateur($this->getReference('user-1'))
                ->setDate($datefuture)
                ->setLieu('mickey')
        ;
        $now = new \DateTime();
        $datepasse = $now->sub(new \DateInterval('P4M'));
        $battlePasse = new Battle();
        $battlePasse->setName('battle passée    ')
                ->setCreateur($this->getReference('user-1'))
                ->setDate($datepasse)
                ->setLieu('mickey')
        ;

        $manager->persist($battleFutur);
        $manager->persist($battlePasse);
        $manager->flush();

        $this->addReference('battle-futur', $battleFutur);
        $this->addReference('battle-passee', $battlePasse);
    }

    public function getOrder()
    {
        return 9;
    }
}