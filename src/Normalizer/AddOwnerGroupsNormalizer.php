<?php

namespace App\Normalizer;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsDecorator('api_platform.jsonld.normalizer.item')]
class AddOwnerGroupsNormalizer implements NormalizerInterface, SerializerAwareInterface {
	public function __construct(private NormalizerInterface $normalizer){

	}

	public function normalize(mixed $object, string $format = null, array $context = []): array|\ArrayObject|bool|float|int|null|string {
		dump('It works');

		return $this->normalizer->normalize($object, $format, $context);
	}

	public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool {
		return $this->normalizer->supportsNormalization($data, $format, $context);
	}

	public function setSerializer(SerializerInterface $serializer) {
		if ($this->normalizer instanceof SerializerAwareInterface) {
			$this->normalizer->setSerializer($serializer);
		}
	}

}