<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 14/09/16
 * Time: 19:34
 */
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Participant extends Constraint
{
    public $message = "Vous devez séléctionnez une armée si vous combattez";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}