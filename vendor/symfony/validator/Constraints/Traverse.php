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
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
<<<<<<< HEAD
 * Validates an object that needs to be traversed.
=======
 * @Annotation
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class Traverse extends Constraint
{
<<<<<<< HEAD
    public bool $traverse = true;

    /**
     * @param bool|array<string,mixed>|null $traverse Whether to traverse the given object or not (defaults to true). Pass an associative array to configure the constraint's options (e.g. payload).
     */
    #[HasNamedArguments]
    public function __construct(bool|array|null $traverse = null, mixed $payload = null)
=======
    public $traverse = true;

    public function __construct(bool|array|null $traverse = null)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (\is_array($traverse) && \array_key_exists('groups', $traverse)) {
            throw new ConstraintDefinitionException(\sprintf('The option "groups" is not supported by the constraint "%s".', __CLASS__));
        }

<<<<<<< HEAD
        if (\is_array($traverse)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

        parent::__construct($traverse, null, $payload);
=======
        parent::__construct($traverse);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getDefaultOption(): ?string
    {
        return 'traverse';
    }

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
