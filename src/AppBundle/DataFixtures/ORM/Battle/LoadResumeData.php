<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 16/12/16
 * Time: 11:56
 */

namespace AppBundle\DataFixtures\ORM\Battle;


use AppBundle\Entity\Battle\Resume;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadResumeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $resume = new Resume();

        $resume->setResume('blblblbl')
            ->setBattle($this->getReference('battle-passee'));

        $manager->persist($resume);
        $manager->flush();

    }

    public function getOrder()
    {
        return 12;
    }
}