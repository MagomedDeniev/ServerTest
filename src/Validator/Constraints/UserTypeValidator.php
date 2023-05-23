<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UserTypeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value != 'personal' && $value != 'business') {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ message }}', 'Custom message')
                          ->addViolation();
        }
    }
}
