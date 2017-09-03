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

class ParticipantValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value->getPresence()->getPresence() === "participerez au combat") {
            if ($value->getArmy() === null || $value->getArmy()->getUser() !== $value->getParticipant()) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('army')
                    ->addViolation();
            }

        }

    }
}
