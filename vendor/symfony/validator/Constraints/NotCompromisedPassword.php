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

/**
 * Checks if a password has been leaked in a data breach.
 *
<<<<<<< HEAD
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class NotCompromisedPassword extends Constraint
{
    public const COMPROMISED_PASSWORD_ERROR = 'd9bcdbfe-a9d6-4bfa-a8ff-da5fd93e0f6d';

    protected const ERROR_NAMES = [
        self::COMPROMISED_PASSWORD_ERROR => 'COMPROMISED_PASSWORD_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This password has been leaked in a data breach, it must not be used. Please use another password.';
    public int $threshold = 1;
    public bool $skipOnError = false;

    /**
     * @param array<string,mixed>|null $options
     * @param positive-int|null        $threshold   The number of times the password should have been leaked to consider it is compromised (defaults to 1)
     * @param bool|null                $skipOnError Whether to ignore HTTP errors while requesting the API and thus consider the password valid (defaults to false)
     * @param string[]|null            $groups
     */
    #[HasNamedArguments]
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This password has been leaked in a data breach, it must not be used. Please use another password.';
    public $threshold = 1;
    public $skipOnError = false;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?int $threshold = null,
        ?bool $skipOnError = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
<<<<<<< HEAD
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->threshold = $threshold ?? $this->threshold;
        $this->skipOnError = $skipOnError ?? $this->skipOnError;
    }
}
