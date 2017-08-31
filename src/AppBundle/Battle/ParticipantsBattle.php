<?php

namespace AppBundle\Battle;

use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\Participant;
use Doctrine\ORM\EntityManager;

class ParticipantsBattle
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function addParticipants(Battle $battle)
    {
        $listUsers = $this->em->getRepository('AppBundle:User\User')->findAll();
        // On boucle sur la liste des participants
        foreach ( $listUsers as $user ) {
            if($user == $battle->getCreateur()) // Si le participant est le créateur, il sera automatiquement présent
            {
                $presence = $this->em->getRepository('AppBundle:Battle\Presence')->findOneBy(array('id' => 1));
            }else{ // sinon le participant n'a pas répondus
                $presence = $this->em->getRepository('AppBundle:Battle\Presence')->findOneBy(array('id' => 4));
            }

            $participant = new Participant();
            $participant->setBattle($battle)
                    ->setParticipant($user)
                    ->setPresence($presence);

            $battle->addParticipant($participant);
        }

    }

}
