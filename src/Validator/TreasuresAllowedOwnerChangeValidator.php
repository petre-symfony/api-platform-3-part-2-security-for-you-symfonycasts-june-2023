<?php

namespace App\Validator;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TreasuresAllowedOwnerChangeValidator extends ConstraintValidator {
	public function validate($value, Constraint $constraint) {
		assert($constraint instanceof TreasuresAllowedOwnerChange);

		if (null === $value || '' === $value) {
			return;
		}

		assert($value instanceof Collection);

		$this->context->buildViolation($constraint->message)
			->setParameter('{{ value }}', $value)
			->addViolation();
	}
}
