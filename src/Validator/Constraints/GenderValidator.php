<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GenderValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value != 'male' && $value != 'female' && $value != 'null') {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ message }}', 'Custom message')
                          ->addViolation();
        }
    }
}
