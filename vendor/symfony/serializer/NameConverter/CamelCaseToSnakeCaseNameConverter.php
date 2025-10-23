<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\NameConverter;

<<<<<<< HEAD
use Symfony\Component\Serializer\Exception\UnexpectedPropertyException;

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
/**
 * CamelCase to Underscore name converter.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
<<<<<<< HEAD
 * @author Aurélien Pillevesse <aurelienpillevesse@hotmail.fr>
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 */
class CamelCaseToSnakeCaseNameConverter implements NameConverterInterface
{
    /**
<<<<<<< HEAD
     * Require all properties to be written in snake_case.
     */
    public const REQUIRE_SNAKE_CASE_PROPERTIES = 'require_snake_case_properties';

    /**
     * @param string[]|null $attributes     The list of attributes to rename or null for all attributes
     * @param bool          $lowerCamelCase Use lowerCamelCase style
=======
     * @param array|null $attributes     The list of attributes to rename or null for all attributes
     * @param bool       $lowerCamelCase Use lowerCamelCase style
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function __construct(
        private ?array $attributes = null,
        private bool $lowerCamelCase = true,
    ) {
    }

<<<<<<< HEAD
    /**
     * @param class-string|null    $class
     * @param string|null          $format
     * @param array<string, mixed> $context
     */
    public function normalize(string $propertyName/* , ?string $class = null, ?string $format = null, array $context = [] */): string
    {
        if (null === $this->attributes || \in_array($propertyName, $this->attributes, true)) {
=======
    public function normalize(string $propertyName): string
    {
        if (null === $this->attributes || \in_array($propertyName, $this->attributes)) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            return strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($propertyName)));
        }

        return $propertyName;
    }

<<<<<<< HEAD
    /**
     * @param class-string|null    $class
     * @param string|null          $format
     * @param array<string, mixed> $context
     */
    public function denormalize(string $propertyName/* , ?string $class = null, ?string $format = null, array $context = [] */): string
    {
        $class = 1 < \func_num_args() ? func_get_arg(1) : null;
        $format = 2 < \func_num_args() ? func_get_arg(2) : null;
        $context = 3 < \func_num_args() ? func_get_arg(3) : [];

        if (($context[self::REQUIRE_SNAKE_CASE_PROPERTIES] ?? false) && $propertyName !== $this->normalize($propertyName, $class, $format, $context)) {
            throw new UnexpectedPropertyException($propertyName);
        }

=======
    public function denormalize(string $propertyName): string
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $camelCasedName = preg_replace_callback('/(^|_|\.)+(.)/', fn ($match) => ('.' === $match[1] ? '_' : '').strtoupper($match[2]), $propertyName);

        if ($this->lowerCamelCase) {
            $camelCasedName = lcfirst($camelCasedName);
        }

<<<<<<< HEAD
        if (null === $this->attributes || \in_array($camelCasedName, $this->attributes, true)) {
=======
        if (null === $this->attributes || \in_array($camelCasedName, $this->attributes)) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            return $camelCasedName;
        }

        return $propertyName;
    }
}
