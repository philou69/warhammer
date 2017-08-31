<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 14/09/16
 * Time: 19:38
 */
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class BattleValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        foreach ($value->getParticipants() as $participant)
        {
            if( $participant->getPresence()->getId() == 3 )
            {
                if( $participant->getArmy() === null || $participant->getArmy()->getUser() !== $participant->getParticipant()  )
                {
                    $this->context->buildViolation($constraint->message)
                        ->addViolation();
                }
            }
        }


    }
}
