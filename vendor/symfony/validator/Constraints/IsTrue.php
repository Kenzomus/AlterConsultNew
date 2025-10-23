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
 * Validates that a value is true.
=======
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class IsTrue extends Constraint
{
    public const NOT_TRUE_ERROR = '2beabf1c-54c0-4882-a928-05249b26e23b';

    protected const ERROR_NAMES = [
        self::NOT_TRUE_ERROR => 'NOT_TRUE_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value should be true.';

    /**
     * @param array<string,mixed>|null $options
     * @param string[]|null            $groups
     */
    #[HasNamedArguments]
    public function __construct(?array $options = null, ?string $message = null, ?array $groups = null, mixed $payload = null)
    {
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value should be true.';

    public function __construct(?array $options = null, ?string $message = null, ?array $groups = null, mixed $payload = null)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($options ?? [], $groups, $payload);

        $this->message = $message ?? $this->message;
    }
}
