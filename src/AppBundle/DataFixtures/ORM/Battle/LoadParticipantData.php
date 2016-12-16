<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 16/12/16
 * Time: 11:20
 */

namespace AppBundle\DataFixtures\ORM\Battle;


use AppBundle\Entity\Battle\Participant;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadParticipantData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $paticipantsName = [
            [
                'participant' => $this->getReference('user-1'),
                'battle' => $this->getReference('battle-futur'),
                'presence' => $this->getReference('presence-4'),
                'army' => null
            ],
            [
                'participant' => $this->getReference('user-2'),
                'battle' => $this->getReference('battle-futur'),
                'presence' => $this->getReference('presence-4'),
                'army' => null
            ],
            [
                'participant' => $this->getReference('user-3'),
                'battle' => $this->getReference('battle-futur'),
                'presence' => $this->getReference('presence-4'),
                'army' => null
            ],
            [
                'participant' => $this->getReference('user-4'),
                'battle' => $this->getReference('battle-futur'),
                'presence' => $this->getReference('presence-4'),
                'army' => null
            ],
            [
                'participant' => $this->getReference('user-1'),
                'battle' => $this->getReference('battle-passee'),
                'presence' => $this->getReference('presence-3'),
                'army' => $this->getReference('army-1')
            ],
            [
                'participant' => $this->getReference('user-2'),
                'battle' => $this->getReference('battle-passee'),
                'presence' => $this->getReference('presence-3'),
                'army' => $this->getReference('army-3')
            ]
        ];
        $i = 1;
        foreach ($paticipantsName as $participantName) {
            $participant = new Participant();

            $participant->setPresence($participantName['presence'])
                ->setArmy($participantName['army'])
                ->setBattle($participantName['battle'])
                ->setParticipant($participantName['participant']);

            $manager->persist($participant);
            $manager->flush();

            $this->addReference('participant-'.$i, $participant);
            $i++;
        }
    }

    public function getOrder()
    {
        return 11;
    }
}