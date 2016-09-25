<?php

namespace AppBundle\Mailer;

use AppBundle\Entity\Battle\Battle;

class SendMailer
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailsBattle(Battle $battle)
    {
        foreach ($battle->getParticipants() as $participant) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Invitation à une battle')
                ->setFrom('site.projet.oc@gmail.com')
                ->setTo($participant->getParticipant()->getEmail())
                ->setBody($this->renderView('AppBundle:Email:battle.html.twig', array('battle' => $battle)), 'text/html')
                ->addPart($this->renderView('AppBundle:Email:battle.txt.twig', array('battle' => $battle)), 'text/plain');

            $this->mailer->send($message);
        }
    }
}