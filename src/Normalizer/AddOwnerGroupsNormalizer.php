<?php

namespace App\Normalizer;

use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AddOwnerGroupsNormalizer implements NormalizerInterface {
	public function normalize(mixed $object, string $format = null, array $context = []): array|\ArrayObject|bool|float|int|null|string {
		// TODO: Implement normalize() method.
	}

	public function supportsNormalization(mixed $data, string $format = null): bool {
		// TODO: Implement supportsNormalization() method.
	}

}