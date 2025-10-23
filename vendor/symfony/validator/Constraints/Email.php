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

use Egulias\EmailValidator\EmailValidator as StrictEmailValidator;
<<<<<<< HEAD
use Symfony\Component\Validator\Attribute\HasNamedArguments;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Exception\LogicException;

/**
<<<<<<< HEAD
 * Validates that a value is a valid email address.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Email extends Constraint
{
    public const VALIDATION_MODE_HTML5_ALLOW_NO_TLD = 'html5-allow-no-tld';
    public const VALIDATION_MODE_HTML5 = 'html5';
    public const VALIDATION_MODE_STRICT = 'strict';
<<<<<<< HEAD
=======
    /**
     * @deprecated since Symfony 6.2, use VALIDATION_MODE_HTML5 instead
     */
    public const VALIDATION_MODE_LOOSE = 'loose';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public const INVALID_FORMAT_ERROR = 'bd79c0ab-ddba-46cc-a703-a7a4b08de310';

    public const VALIDATION_MODES = [
        self::VALIDATION_MODE_HTML5_ALLOW_NO_TLD,
        self::VALIDATION_MODE_HTML5,
        self::VALIDATION_MODE_STRICT,
<<<<<<< HEAD
=======
        self::VALIDATION_MODE_LOOSE,
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ];

    protected const ERROR_NAMES = [
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value is not a valid email address.';
    public ?string $mode = null;
    /** @var callable|null */
    public $normalizer;

    /**
     * @param array<string,mixed>|null     $options
     * @param self::VALIDATION_MODE_*|null $mode    The pattern used to validate the email address; pass null to use the default mode configured for the EmailValidator
     * @param string[]|null                $groups
     */
    #[HasNamedArguments]
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value is not a valid email address.';
    public $mode;
    /** @var callable|null */
    public $normalizer;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?string $mode = null,
        ?callable $normalizer = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        if (\is_array($options) && \array_key_exists('mode', $options) && !\in_array($options['mode'], self::VALIDATION_MODES, true)) {
            throw new InvalidArgumentException('The "mode" parameter value is not valid.');
        }

        if (null !== $mode && !\in_array($mode, self::VALIDATION_MODES, true)) {
            throw new InvalidArgumentException('The "mode" parameter value is not valid.');
        }

<<<<<<< HEAD
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->mode = $mode ?? $this->mode;
        $this->normalizer = $normalizer ?? $this->normalizer;

<<<<<<< HEAD
=======
        if (self::VALIDATION_MODE_LOOSE === $this->mode) {
            trigger_deprecation('symfony/validator', '6.2', 'The "%s" mode is deprecated. It will be removed in 7.0 and the default mode will be changed to "%s".', self::VALIDATION_MODE_LOOSE, self::VALIDATION_MODE_HTML5);
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if (self::VALIDATION_MODE_STRICT === $this->mode && !class_exists(StrictEmailValidator::class)) {
            throw new LogicException(\sprintf('The "egulias/email-validator" component is required to use the "%s" constraint in strict mode. Try running "composer require egulias/email-validator".', __CLASS__));
        }

        if (null !== $this->normalizer && !\is_callable($this->normalizer)) {
            throw new InvalidArgumentException(\sprintf('The "normalizer" option must be a valid callable ("%s" given).', get_debug_type($this->normalizer)));
        }
    }
}
