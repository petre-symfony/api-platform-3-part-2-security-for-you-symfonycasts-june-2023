<?php

namespace App\Validator;

use App\Entity\DragonTreasure;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TreasuresAllowedOwnerChangeValidator extends ConstraintValidator {
	public function __construct(private EntityManagerInterface $entityManager) {

	}

	public function validate($value, Constraint $constraint) {
		assert($constraint instanceof TreasuresAllowedOwnerChange);

		if (null === $value || '' === $value) {
			return;
		}

		assert($value instanceof Collection);

		$unitOfWork = $this->entityManager->getUnitOfWork();
		foreach ($value as $dragontreasure) {
			assert($dragontreasure instanceof DragonTreasure);

			$originalData = $unitOfWork->getOriginalEntityData($dragontreasure);
			dd($dragontreasure, $originalData);
		}

		$this->context->buildViolation($constraint->message)
			->setParameter('{{ value }}', $value)
			->addViolation();
	}
}
