<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Normalizer;

<<<<<<< HEAD
=======
use Symfony\Component\PropertyInfo\Type;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;

/**
 * Normalizes an object implementing the {@see \DateTimeInterface} to a date string.
 * Denormalizes a date string to an instance of {@see \DateTime} or {@see \DateTimeImmutable}.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
<<<<<<< HEAD
 */
final class DateTimeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public const FORMAT_KEY = 'datetime_format';
    public const TIMEZONE_KEY = 'datetime_timezone';
    public const CAST_KEY = 'datetime_cast';
=======
 *
 * @final since Symfony 6.3
 */
class DateTimeNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    public const FORMAT_KEY = 'datetime_format';
    public const TIMEZONE_KEY = 'datetime_timezone';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    private array $defaultContext = [
        self::FORMAT_KEY => \DateTimeInterface::RFC3339,
        self::TIMEZONE_KEY => null,
<<<<<<< HEAD
        self::CAST_KEY => null,
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ];

    private const SUPPORTED_TYPES = [
        \DateTimeInterface::class => true,
        \DateTimeImmutable::class => true,
        \DateTime::class => true,
    ];

    public function __construct(array $defaultContext = [])
    {
        $this->setDefaultContext($defaultContext);
    }

    public function setDefaultContext(array $defaultContext): void
    {
        $this->defaultContext = array_merge($this->defaultContext, $defaultContext);
    }

    public function getSupportedTypes(?string $format): array
    {
<<<<<<< HEAD
        return self::SUPPORTED_TYPES;
=======
        $isCacheable = __CLASS__ === static::class || $this->hasCacheableSupportsMethod();

        return [
            \DateTimeInterface::class => $isCacheable,
            \DateTimeImmutable::class => $isCacheable,
            \DateTime::class => $isCacheable,
        ];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * @throws InvalidArgumentException
     */
<<<<<<< HEAD
    public function normalize(mixed $data, ?string $format = null, array $context = []): int|float|string
    {
        if (!$data instanceof \DateTimeInterface) {
=======
    public function normalize(mixed $object, ?string $format = null, array $context = []): string
    {
        if (!$object instanceof \DateTimeInterface) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            throw new InvalidArgumentException('The object must implement the "\DateTimeInterface".');
        }

        $dateTimeFormat = $context[self::FORMAT_KEY] ?? $this->defaultContext[self::FORMAT_KEY];
        $timezone = $this->getTimezone($context);

        if (null !== $timezone) {
<<<<<<< HEAD
            $data = clone $data;
            $data = $data->setTimezone($timezone);
        }

        return match ($context[self::CAST_KEY] ?? $this->defaultContext[self::CAST_KEY] ?? false) {
            'int' => (int) $data->format($dateTimeFormat),
            'float' => (float) $data->format($dateTimeFormat),
            default => $data->format($dateTimeFormat),
        };
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
=======
            $object = clone $object;
            $object = $object->setTimezone($timezone);
        }

        return $object->format($dateTimeFormat);
    }

    /**
     * @param array $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null /* , array $context = [] */): bool
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $data instanceof \DateTimeInterface;
    }

    /**
     * @throws NotNormalizableValueException
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): \DateTimeInterface
    {
        if (\is_int($data) || \is_float($data)) {
            switch ($context[self::FORMAT_KEY] ?? $this->defaultContext[self::FORMAT_KEY] ?? null) {
<<<<<<< HEAD
                case 'U':
                    $data = \sprintf('%d', $data);
                    break;
                case 'U.u':
                    $data = \sprintf('%.6F', $data);
                    break;
=======
                case 'U': $data = \sprintf('%d', $data); break;
                case 'U.u': $data = \sprintf('%.6F', $data); break;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }

        if (!\is_string($data) || '' === trim($data)) {
<<<<<<< HEAD
            throw NotNormalizableValueException::createForUnexpectedDataType('The data is either not an string, an empty string, or null; you should pass a string that can be parsed with the passed format or a valid DateTime string.', $data, ['string'], $context['deserialization_path'] ?? null, true);
=======
            throw NotNormalizableValueException::createForUnexpectedDataType('The data is either not an string, an empty string, or null; you should pass a string that can be parsed with the passed format or a valid DateTime string.', $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        try {
            if (\DateTimeInterface::class === $type) {
                $type = \DateTimeImmutable::class;
            }

            $timezone = $this->getTimezone($context);
            $dateTimeFormat = $context[self::FORMAT_KEY] ?? null;

            if (null !== $dateTimeFormat) {
                if (false !== $object = $type::createFromFormat($dateTimeFormat, $data, $timezone)) {
                    return $object;
                }

                $dateTimeErrors = $type::getLastErrors();

<<<<<<< HEAD
                throw NotNormalizableValueException::createForUnexpectedDataType(\sprintf('Parsing datetime string "%s" using format "%s" resulted in %d errors: ', $data, $dateTimeFormat, $dateTimeErrors['error_count'])."\n".implode("\n", $this->formatDateTimeErrors($dateTimeErrors['errors'])), $data, ['string'], $context['deserialization_path'] ?? null, true);
=======
                throw NotNormalizableValueException::createForUnexpectedDataType(\sprintf('Parsing datetime string "%s" using format "%s" resulted in %d errors: ', $data, $dateTimeFormat, $dateTimeErrors['error_count'])."\n".implode("\n", $this->formatDateTimeErrors($dateTimeErrors['errors'])), $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            $defaultDateTimeFormat = $this->defaultContext[self::FORMAT_KEY] ?? null;

            if (null !== $defaultDateTimeFormat) {
                if (false !== $object = $type::createFromFormat($defaultDateTimeFormat, $data, $timezone)) {
                    return $object;
                }
            }

            return new $type($data, $timezone);
        } catch (NotNormalizableValueException $e) {
            throw $e;
        } catch (\Exception $e) {
<<<<<<< HEAD
            throw NotNormalizableValueException::createForUnexpectedDataType($e->getMessage(), $data, ['string'], $context['deserialization_path'] ?? null, false, $e->getCode(), $e);
        }
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return is_a($type, \DateTimeInterface::class, true);
=======
            throw NotNormalizableValueException::createForUnexpectedDataType($e->getMessage(), $data, [Type::BUILTIN_TYPE_STRING], $context['deserialization_path'] ?? null, false, $e->getCode(), $e);
        }
    }

    /**
     * @param array $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null /* , array $context = [] */): bool
    {
        return isset(self::SUPPORTED_TYPES[$type]);
    }

    /**
     * @deprecated since Symfony 6.3, use "getSupportedTypes()" instead
     */
    public function hasCacheableSupportsMethod(): bool
    {
        trigger_deprecation('symfony/serializer', '6.3', 'The "%s()" method is deprecated, implement "%s::getSupportedTypes()" instead.', __METHOD__, get_debug_type($this));

        return __CLASS__ === static::class;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * Formats datetime errors.
     *
     * @return string[]
     */
    private function formatDateTimeErrors(array $errors): array
    {
        $formattedErrors = [];

        foreach ($errors as $pos => $message) {
            $formattedErrors[] = \sprintf('at position %d: %s', $pos, $message);
        }

        return $formattedErrors;
    }

    private function getTimezone(array $context): ?\DateTimeZone
    {
        $dateTimeZone = $context[self::TIMEZONE_KEY] ?? $this->defaultContext[self::TIMEZONE_KEY];

        if (null === $dateTimeZone) {
            return null;
        }

        return $dateTimeZone instanceof \DateTimeZone ? $dateTimeZone : new \DateTimeZone($dateTimeZone);
    }
}
