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
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @internal
 *
 * @author Jan Schädlich <jan.schaedlich@sensiolabs.de>
 * @author Alexander M. Turek <me@derrabus.de>
 */
trait ZeroComparisonConstraintTrait
{
<<<<<<< HEAD
    #[HasNamedArguments]
    public function __construct(?array $options = null, ?string $message = null, ?array $groups = null, mixed $payload = null)
    {
        if (null !== $options) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

        if (\is_array($options) && isset($options['propertyPath'])) {
            throw new ConstraintDefinitionException(\sprintf('The "propertyPath" option of the "%s" constraint cannot be set.', static::class));
        }

        if (\is_array($options) && isset($options['value'])) {
=======
    public function __construct(?array $options = null, ?string $message = null, ?array $groups = null, mixed $payload = null)
    {
        $options ??= [];

        if (isset($options['propertyPath'])) {
            throw new ConstraintDefinitionException(\sprintf('The "propertyPath" option of the "%s" constraint cannot be set.', static::class));
        }

        if (isset($options['value'])) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            throw new ConstraintDefinitionException(\sprintf('The "value" option of the "%s" constraint cannot be set.', static::class));
        }

        parent::__construct(0, null, $message, $groups, $payload, $options);
    }

    public function validatedBy(): string
    {
        return parent::class.'Validator';
    }
}
