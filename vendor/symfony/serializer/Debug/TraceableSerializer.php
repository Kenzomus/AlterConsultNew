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
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
<<<<<<< HEAD
=======
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Collects some data about serialization.
 *
 * @author Mathias Arlaud <mathias.arlaud@gmail.com>
 *
 * @final
 */
class TraceableSerializer implements SerializerInterface, NormalizerInterface, DenormalizerInterface, EncoderInterface, DecoderInterface
{
    public const DEBUG_TRACE_ID = 'debug_trace_id';

    public function __construct(
        private SerializerInterface&NormalizerInterface&DenormalizerInterface&EncoderInterface&DecoderInterface $serializer,
        private SerializerDataCollector $dataCollector,
<<<<<<< HEAD
        private readonly string $serializerName = 'default',
    ) {
=======
    ) {
        if (!method_exists($serializer, 'getSupportedTypes')) {
            trigger_deprecation('symfony/serializer', '6.3', 'Not implementing the "NormalizerInterface::getSupportedTypes()" in "%s" is deprecated.', get_debug_type($serializer));
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function serialize(mixed $data, string $format, array $context = []): string
    {
<<<<<<< HEAD
        $context[self::DEBUG_TRACE_ID] = $traceId = bin2hex(random_bytes(4));
=======
        $context[self::DEBUG_TRACE_ID] = $traceId = uniqid('', true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $startTime = microtime(true);
        $result = $this->serializer->serialize($data, $format, $context);
        $time = microtime(true) - $startTime;

        $caller = $this->getCaller(__FUNCTION__, SerializerInterface::class);

<<<<<<< HEAD
        $this->dataCollector->collectSerialize($traceId, $data, $format, $context, $time, $caller, $this->serializerName);
=======
        $this->dataCollector->collectSerialize($traceId, $data, $format, $context, $time, $caller);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return $result;
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
<<<<<<< HEAD
        $context[self::DEBUG_TRACE_ID] = $traceId = bin2hex(random_bytes(4));
=======
        $context[self::DEBUG_TRACE_ID] = $traceId = uniqid('', true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $startTime = microtime(true);
        $result = $this->serializer->deserialize($data, $type, $format, $context);
        $time = microtime(true) - $startTime;

        $caller = $this->getCaller(__FUNCTION__, SerializerInterface::class);

<<<<<<< HEAD
        $this->dataCollector->collectDeserialize($traceId, $data, $type, $format, $context, $time, $caller, $this->serializerName);
=======
        $this->dataCollector->collectDeserialize($traceId, $data, $type, $format, $context, $time, $caller);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return $result;
    }

<<<<<<< HEAD
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $context[self::DEBUG_TRACE_ID] = $traceId = bin2hex(random_bytes(4));

        $startTime = microtime(true);
        $result = $this->serializer->normalize($data, $format, $context);
=======
    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $context[self::DEBUG_TRACE_ID] = $traceId = uniqid('', true);

        $startTime = microtime(true);
        $result = $this->serializer->normalize($object, $format, $context);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $time = microtime(true) - $startTime;

        $caller = $this->getCaller(__FUNCTION__, NormalizerInterface::class);

<<<<<<< HEAD
        $this->dataCollector->collectNormalize($traceId, $data, $format, $context, $time, $caller, $this->serializerName);
=======
        $this->dataCollector->collectNormalize($traceId, $object, $format, $context, $time, $caller);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return $result;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
<<<<<<< HEAD
        $context[self::DEBUG_TRACE_ID] = $traceId = bin2hex(random_bytes(4));
=======
        $context[self::DEBUG_TRACE_ID] = $traceId = uniqid('', true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $startTime = microtime(true);
        $result = $this->serializer->denormalize($data, $type, $format, $context);
        $time = microtime(true) - $startTime;

        $caller = $this->getCaller(__FUNCTION__, DenormalizerInterface::class);

<<<<<<< HEAD
        $this->dataCollector->collectDenormalize($traceId, $data, $type, $format, $context, $time, $caller, $this->serializerName);
=======
        $this->dataCollector->collectDenormalize($traceId, $data, $type, $format, $context, $time, $caller);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return $result;
    }

    public function encode(mixed $data, string $format, array $context = []): string
    {
<<<<<<< HEAD
        $context[self::DEBUG_TRACE_ID] = $traceId = bin2hex(random_bytes(4));
=======
        $context[self::DEBUG_TRACE_ID] = $traceId = uniqid('', true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $startTime = microtime(true);
        $result = $this->serializer->encode($data, $format, $context);
        $time = microtime(true) - $startTime;

        $caller = $this->getCaller(__FUNCTION__, EncoderInterface::class);

<<<<<<< HEAD
        $this->dataCollector->collectEncode($traceId, $data, $format, $context, $time, $caller, $this->serializerName);
=======
        $this->dataCollector->collectEncode($traceId, $data, $format, $context, $time, $caller);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return $result;
    }

    public function decode(string $data, string $format, array $context = []): mixed
    {
<<<<<<< HEAD
        $context[self::DEBUG_TRACE_ID] = $traceId = bin2hex(random_bytes(4));
=======
        $context[self::DEBUG_TRACE_ID] = $traceId = uniqid('', true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $startTime = microtime(true);
        $result = $this->serializer->decode($data, $format, $context);
        $time = microtime(true) - $startTime;

        $caller = $this->getCaller(__FUNCTION__, DecoderInterface::class);

<<<<<<< HEAD
        $this->dataCollector->collectDecode($traceId, $data, $format, $context, $time, $caller, $this->serializerName);
=======
        $this->dataCollector->collectDecode($traceId, $data, $format, $context, $time, $caller);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return $result;
    }

    public function getSupportedTypes(?string $format): array
    {
<<<<<<< HEAD
=======
        // @deprecated remove condition in 7.0
        if (!method_exists($this->serializer, 'getSupportedTypes')) {
            return ['*' => $this->serializer instanceof CacheableSupportsMethodInterface && $this->serializer->hasCacheableSupportsMethod()];
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        return $this->serializer->getSupportedTypes($format);
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $this->serializer->supportsNormalization($data, $format, $context);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $this->serializer->supportsDenormalization($data, $type, $format, $context);
    }

    public function supportsEncoding(string $format, array $context = []): bool
    {
        return $this->serializer->supportsEncoding($format, $context);
    }

    public function supportsDecoding(string $format, array $context = []): bool
    {
        return $this->serializer->supportsDecoding($format, $context);
    }

    /**
     * Proxies all method calls to the original serializer.
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->serializer->{$method}(...$arguments);
    }

    private function getCaller(string $method, string $interface): array
    {
        $trace = debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS, 8);

        $file = $trace[0]['file'];
        $line = $trace[0]['line'];

        for ($i = 1; $i < 8; ++$i) {
            if (isset($trace[$i]['class'], $trace[$i]['function'])
                && $method === $trace[$i]['function']
                && is_a($trace[$i]['class'], $interface, true)
            ) {
                $file = $trace[$i]['file'] ?? $trace[$i + 1]['file'];
                $line = $trace[$i]['line'] ?? $trace[$i + 1]['line'];

                break;
            }
        }

        $name = str_replace('\\', '/', $file);
        $name = substr($name, strrpos($name, '/') + 1);

        return compact('name', 'file', 'line');
    }
}
