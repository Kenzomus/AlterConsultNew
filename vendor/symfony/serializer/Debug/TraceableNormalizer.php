<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Debug;

use Symfony\Component\Serializer\DataCollector\SerializerDataCollector;
<<<<<<< HEAD
=======
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Collects some data about normalization.
 *
 * @author Mathias Arlaud <mathias.arlaud@gmail.com>
 *
 * @final
 */
<<<<<<< HEAD
class TraceableNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface, NormalizerAwareInterface, DenormalizerAwareInterface
=======
class TraceableNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface, NormalizerAwareInterface, DenormalizerAwareInterface, CacheableSupportsMethodInterface
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
{
    public function __construct(
        private NormalizerInterface|DenormalizerInterface $normalizer,
        private SerializerDataCollector $dataCollector,
<<<<<<< HEAD
        private readonly string $serializerName = 'default',
    ) {
=======
    ) {
        if (!method_exists($normalizer, 'getSupportedTypes')) {
            trigger_deprecation('symfony/serializer', '6.3', 'Not implementing the "NormalizerInterface::getSupportedTypes()" in "%s" is deprecated.', get_debug_type($normalizer));
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getSupportedTypes(?string $format): array
    {
<<<<<<< HEAD
        return $this->normalizer->getSupportedTypes($format);
    }

    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
=======
        // @deprecated remove condition in 7.0
        if (!method_exists($this->normalizer, 'getSupportedTypes')) {
            return ['*' => $this->normalizer instanceof CacheableSupportsMethodInterface && $this->normalizer->hasCacheableSupportsMethod()];
        }

        return $this->normalizer->getSupportedTypes($format);
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (!$this->normalizer instanceof NormalizerInterface) {
            throw new \BadMethodCallException(\sprintf('The "%s()" method cannot be called as nested normalizer doesn\'t implements "%s".', __METHOD__, NormalizerInterface::class));
        }

        $startTime = microtime(true);
<<<<<<< HEAD
        $normalized = $this->normalizer->normalize($data, $format, $context);
        $time = microtime(true) - $startTime;

        if ($traceId = ($context[TraceableSerializer::DEBUG_TRACE_ID] ?? null)) {
            $this->dataCollector->collectNormalization($traceId, $this->normalizer::class, $time, $this->serializerName);
=======
        $normalized = $this->normalizer->normalize($object, $format, $context);
        $time = microtime(true) - $startTime;

        if ($traceId = ($context[TraceableSerializer::DEBUG_TRACE_ID] ?? null)) {
            $this->dataCollector->collectNormalization($traceId, $this->normalizer::class, $time);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $normalized;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        if (!$this->normalizer instanceof NormalizerInterface) {
            return false;
        }

        return $this->normalizer->supportsNormalization($data, $format, $context);
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (!$this->normalizer instanceof DenormalizerInterface) {
            throw new \BadMethodCallException(\sprintf('The "%s()" method cannot be called as nested normalizer doesn\'t implements "%s".', __METHOD__, DenormalizerInterface::class));
        }

        $startTime = microtime(true);
        $denormalized = $this->normalizer->denormalize($data, $type, $format, $context);
        $time = microtime(true) - $startTime;

        if ($traceId = ($context[TraceableSerializer::DEBUG_TRACE_ID] ?? null)) {
<<<<<<< HEAD
            $this->dataCollector->collectDenormalization($traceId, $this->normalizer::class, $time, $this->serializerName);
=======
            $this->dataCollector->collectDenormalization($traceId, $this->normalizer::class, $time);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $denormalized;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        if (!$this->normalizer instanceof DenormalizerInterface) {
            return false;
        }

        return $this->normalizer->supportsDenormalization($data, $type, $format, $context);
    }

    public function setSerializer(SerializerInterface $serializer): void
    {
        if (!$this->normalizer instanceof SerializerAwareInterface) {
            return;
        }

        $this->normalizer->setSerializer($serializer);
    }

    public function setNormalizer(NormalizerInterface $normalizer): void
    {
        if (!$this->normalizer instanceof NormalizerAwareInterface) {
            return;
        }

        $this->normalizer->setNormalizer($normalizer);
    }

    public function setDenormalizer(DenormalizerInterface $denormalizer): void
    {
        if (!$this->normalizer instanceof DenormalizerAwareInterface) {
            return;
        }

        $this->normalizer->setDenormalizer($denormalizer);
    }

    /**
<<<<<<< HEAD
=======
     * @deprecated since Symfony 6.3, use "getSupportedTypes()" instead
     */
    public function hasCacheableSupportsMethod(): bool
    {
        trigger_deprecation('symfony/serializer', '6.3', 'The "%s()" method is deprecated, implement "%s::getSupportedTypes()" instead.', __METHOD__, get_debug_type($this->normalizer));

        return $this->normalizer instanceof CacheableSupportsMethodInterface && $this->normalizer->hasCacheableSupportsMethod();
    }

    /**
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     * Proxies all method calls to the original normalizer.
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->normalizer->{$method}(...$arguments);
    }
}
