<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute] class Gender extends Constraint
{
    public string $message = '{{ message }}';
    public array $fields = [];

    public function validatedBy(): string
    {
        return \get_class($this).'Validator';
    }

    public function getTargets(): array|string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getDefaultOption(): string
    {
        return 'fields';
    }
}
