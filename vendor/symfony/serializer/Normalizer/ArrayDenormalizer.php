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
use Symfony\Component\PropertyInfo\Type as LegacyType;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\TypeInfo\Type;
use Symfony\Component\TypeInfo\Type\BuiltinType;
use Symfony\Component\TypeInfo\Type\UnionType;
use Symfony\Component\TypeInfo\TypeIdentifier;
=======
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Denormalizes arrays of objects.
 *
 * @author Alexander M. Turek <me@derrabus.de>
 *
 * @final
 */
<<<<<<< HEAD
class ArrayDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

=======
class ArrayDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface, CacheableSupportsMethodInterface
{
    use DenormalizerAwareTrait;

    public function setDenormalizer(DenormalizerInterface $denormalizer): void
    {
        if (!method_exists($denormalizer, 'getSupportedTypes')) {
            trigger_deprecation('symfony/serializer', '6.3', 'Not implementing the "DenormalizerInterface::getSupportedTypes()" in "%s" is deprecated.', get_debug_type($denormalizer));
        }

        $this->denormalizer = $denormalizer;
    }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function getSupportedTypes(?string $format): array
    {
        return ['object' => null, '*' => false];
    }

    /**
     * @throws NotNormalizableValueException
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): array
    {
<<<<<<< HEAD
        if (!isset($this->denormalizer)) {
            throw new BadMethodCallException('Please set a denormalizer before calling denormalize()!');
        }
        if (!\is_array($data)) {
            throw NotNormalizableValueException::createForUnexpectedDataType(\sprintf('Data expected to be "%s", "%s" given.', $type, get_debug_type($data)), $data, ['array'], $context['deserialization_path'] ?? null);
=======
        if (null === $this->denormalizer) {
            throw new BadMethodCallException('Please set a denormalizer before calling denormalize()!');
        }
        if (!\is_array($data)) {
            throw NotNormalizableValueException::createForUnexpectedDataType(\sprintf('Data expected to be "%s", "%s" given.', $type, get_debug_type($data)), $data, [Type::BUILTIN_TYPE_ARRAY], $context['deserialization_path'] ?? null);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }
        if (!str_ends_with($type, '[]')) {
            throw new InvalidArgumentException('Unsupported class: '.$type);
        }

        $type = substr($type, 0, -2);

<<<<<<< HEAD
        $typeIdentifiers = [];
        if (null !== $keyType = ($context['key_type'] ?? null)) {
            if ($keyType instanceof Type) {
                // BC layer for type-info < 7.2
                if (method_exists(Type::class, 'getBaseType')) {
                    $typeIdentifiers = array_map(fn (Type $t): string => $t->getBaseType()->getTypeIdentifier()->value, $keyType instanceof UnionType ? $keyType->getTypes() : [$keyType]);
                } else {
                    /** @var list<BuiltinType<TypeIdentifier::INT>|BuiltinType<TypeIdentifier::STRING>> */
                    $keyTypes = $keyType instanceof UnionType ? $keyType->getTypes() : [$keyType];

                    $typeIdentifiers = array_map(fn (BuiltinType $t): string => $t->getTypeIdentifier()->value, $keyTypes);
                }
            } else {
                $typeIdentifiers = array_map(fn (LegacyType $t): string => $t->getBuiltinType(), \is_array($keyType) ? $keyType : [$keyType]);
            }
        }
=======
        $builtinTypes = array_map(static function (Type $keyType) {
            return $keyType->getBuiltinType();
        }, \is_array($keyType = $context['key_type'] ?? []) ? $keyType : [$keyType]);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        foreach ($data as $key => $value) {
            $subContext = $context;
            $subContext['deserialization_path'] = ($context['deserialization_path'] ?? false) ? \sprintf('%s[%s]', $context['deserialization_path'], $key) : "[$key]";

<<<<<<< HEAD
            $this->validateKeyType($typeIdentifiers, $key, $subContext['deserialization_path']);
=======
            $this->validateKeyType($builtinTypes, $key, $subContext['deserialization_path']);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

            $data[$key] = $this->denormalizer->denormalize($value, $type, $format, $subContext);
        }

        return $data;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
<<<<<<< HEAD
        if (!isset($this->denormalizer)) {
=======
        if (null === $this->denormalizer) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            throw new BadMethodCallException(\sprintf('The nested denormalizer needs to be set to allow "%s()" to be used.', __METHOD__));
        }

        return str_ends_with($type, '[]')
            && $this->denormalizer->supportsDenormalization($data, substr($type, 0, -2), $format, $context);
    }

    /**
<<<<<<< HEAD
     * @param list<string> $typeIdentifiers
     */
    private function validateKeyType(array $typeIdentifiers, mixed $key, string $path): void
    {
        if (!$typeIdentifiers) {
            return;
        }

        foreach ($typeIdentifiers as $typeIdentifier) {
            if (('is_'.$typeIdentifier)($key)) {
=======
     * @deprecated since Symfony 6.3, use "getSupportedTypes()" instead
     */
    public function hasCacheableSupportsMethod(): bool
    {
        trigger_deprecation('symfony/serializer', '6.3', 'The "%s()" method is deprecated, use "getSupportedTypes()" instead.', __METHOD__);

        return $this->denormalizer instanceof CacheableSupportsMethodInterface && $this->denormalizer->hasCacheableSupportsMethod();
    }

    /**
     * @param mixed $key
     */
    private function validateKeyType(array $builtinTypes, $key, string $path): void
    {
        if (!$builtinTypes) {
            return;
        }

        foreach ($builtinTypes as $builtinType) {
            if (('is_'.$builtinType)($key)) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                return;
            }
        }

<<<<<<< HEAD
        throw NotNormalizableValueException::createForUnexpectedDataType(\sprintf('The type of the key "%s" must be "%s" ("%s" given).', $key, implode('", "', $typeIdentifiers), get_debug_type($key)), $key, $typeIdentifiers, $path, true);
=======
        throw NotNormalizableValueException::createForUnexpectedDataType(\sprintf('The type of the key "%s" must be "%s" ("%s" given).', $key, implode('", "', $builtinTypes), get_debug_type($key)), $key, $builtinTypes, $path, true);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
