<?php

namespace App\Validator;

use App\Entity\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidOwnerValidator extends ConstraintValidator {
	public function validate($value, Constraint $constraint) {
		assert($constraint instanceof IsValidOwner);

		if (null === $value || '' === $value) {
			return;
		}

		assert($value instanceof User);

		$this->context->buildViolation($constraint->message)
			->addViolation();
	}
}
