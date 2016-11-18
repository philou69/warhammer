<?php

namespace AppBundle\Mail;

use AppBundle\Entity\Battle\Battle;

class SendMail
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendMailBattle(Battle $battle)
    {
        // On boucle sur les invités de la battle

            $message = \Swift_Message::newInstance()
                ->setSubject('Invitation à une battle')
                ->setFrom('administrateur@warhantmillebattle.fr');
                foreach ($battle->getParticipants() as $participant) {
                    // On s'assure de ne pas envoyer de mail au créateur de la bataille
                    if($participant !== $battle->getCreateur()){
                        $message->addBcc($participant->getParticipant()->getEmail(), $participant->getParticipant()->getUsername());
            }
                }
             $message->setBody($this->twig->render('AppBundle:Email:battle.html.twig', array('battle' => $battle)), 'text/html')
                ->addPart($this->twig->render('AppBundle:Email:battle.txt.twig', array('battle' => $battle)), 'text/plain');

            $this->mailer->send($message);

    }

    public function sendCancelBattle(Battle $battle)
    {
            $message = \Swift_Message::newInstance()
                    ->setSubject('Bataille annullée')
                    ->setFrom('administrateur@warhantmillebattle.fr');
                foreach ($battle->getParticipants() as $participant) {
                    // On s'assure de ne pas envoyer de mail au créateur de la bataille
                    if($participant !== $battle->getCreateur()){
                        $message->addBcc($participant->getParticipant()->getEmail(), $participant->getParticipant()->getUsername());
                    }
                }
                $message->setBody($this->twig->render('AppBundle:Email:cancel.html.twig', array('battle' => $battle)), 'text/html')
                    ->addPart($this->twig->render('AppBundle:Email:cancel.txt.twig', array('battle' => $battle)), 'text/plain');

                $this->mailer->send($message);
    }

    public function sendModifiedBattle(Battle $battle)
    {

        $message = \Swift_Message::newInstance()
                    ->setSubject($battle->getName().' a été modifié')
                    ->setFrom('administrateur@warhantmillebattle.fr');
                foreach ($battle->getParticipants() as $participant) {
                    // On s'assure de ne pas envoyer de mail au créateur de la bataille
                    if($participant !== $battle->getCreateur()){
                        $message->addBcc($participant->getParticipant()->getEmail(), $participant->getParticipant()->getUsername());
                    }
                }
                $message->setBody($this->twig->render('AppBundle:Email:update.html.twig', array('battle' => $battle)), 'text/html')
                    ->addPart($this->twig->render('AppBundle:Email:update.txt.twig', array('battle' => $battle)), 'text/plain');

                $this->mailer->send($message);
    }
}