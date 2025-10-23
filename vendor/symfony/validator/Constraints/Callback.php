<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

<<<<<<< HEAD
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

/**
 * Defines custom validation rules through arbitrary callback methods.
=======
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Callback extends Constraint
{
    /**
     * @var string|callable
     */
    public $callback;

<<<<<<< HEAD
    /**
     * @param string|string[]|callable|array<string,mixed>|null $callback The callback definition
     * @param string[]|null                                     $groups
     */
    #[HasNamedArguments]
    public function __construct(array|string|callable|null $callback = null, ?array $groups = null, mixed $payload = null, ?array $options = null)
    {
        // Invocation through attributes with an array parameter only
        if (\is_array($callback) && 1 === \count($callback) && isset($callback['value'])) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);

=======
    public function __construct(array|string|callable|null $callback = null, ?array $groups = null, mixed $payload = null, array $options = [])
    {
        // Invocation through annotations with an array parameter only
        if (\is_array($callback) && 1 === \count($callback) && isset($callback['value'])) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $callback = $callback['value'];
        }

        if (!\is_array($callback) || (!isset($callback['callback']) && !isset($callback['groups']) && !isset($callback['payload']))) {
<<<<<<< HEAD
            if (\is_array($options)) {
                trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
            } else {
                $options = [];
            }

            $options['callback'] = $callback;
        } else {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);

            $options = array_merge($callback, $options ?? []);
=======
            $options['callback'] = $callback;
        } else {
            $options = array_merge($callback, $options);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        parent::__construct($options, $groups, $payload);
    }

    public function getDefaultOption(): ?string
    {
        return 'callback';
    }

    public function getTargets(): string|array
    {
        return [self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT];
    }
}
