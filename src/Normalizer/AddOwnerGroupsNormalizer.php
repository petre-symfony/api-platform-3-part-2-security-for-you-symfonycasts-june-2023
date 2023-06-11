<?php

namespace App\Normalizer;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[AsDecorator('serializer')]
class AddOwnerGroupsNormalizer implements NormalizerInterface {
	public function __construct(private NormalizerInterface $normalizer){

	}

	public function normalize(mixed $object, string $format = null, array $context = []): array|\ArrayObject|bool|float|int|null|string {
		dump('It works');

		return $this->normalizer->normalize($object, $format, $context);
	}

	public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool {
		return $this->normalizer->supportsNormalization($data, $format, $context);
	}

}