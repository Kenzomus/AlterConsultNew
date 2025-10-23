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
 * Validates that a value is a valid host name.
=======
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Dmitrii Poddubnyi <dpoddubny@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Hostname extends Constraint
{
    public const INVALID_HOSTNAME_ERROR = '7057ffdb-0af4-4f7e-bd5e-e9acfa6d7a2d';

    protected const ERROR_NAMES = [
        self::INVALID_HOSTNAME_ERROR => 'INVALID_HOSTNAME_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value is not a valid hostname.';
    public bool $requireTld = true;

    /**
     * @param array<string,mixed>|null $options
     * @param bool|null                $requireTld Whether to require the hostname to include its top-level domain (defaults to true)
     * @param string[]|null            $groups
     */
    #[HasNamedArguments]
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value is not a valid hostname.';
    public $requireTld = true;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?bool $requireTld = null,
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
        $this->requireTld = $requireTld ?? $this->requireTld;
    }
}
