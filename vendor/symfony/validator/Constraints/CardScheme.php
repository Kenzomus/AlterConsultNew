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
 * Validates a credit card number for a given credit card company.
=======
use Symfony\Component\Validator\Constraint;

/**
 * Metadata for the CardSchemeValidator.
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Tim Nagel <t.nagel@infinite.net.au>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class CardScheme extends Constraint
{
    public const AMEX = 'AMEX';
    public const CHINA_UNIONPAY = 'CHINA_UNIONPAY';
    public const DINERS = 'DINERS';
    public const DISCOVER = 'DISCOVER';
    public const INSTAPAYMENT = 'INSTAPAYMENT';
    public const JCB = 'JCB';
    public const LASER = 'LASER';
    public const MAESTRO = 'MAESTRO';
    public const MASTERCARD = 'MASTERCARD';
    public const MIR = 'MIR';
    public const UATP = 'UATP';
    public const VISA = 'VISA';

    public const NOT_NUMERIC_ERROR = 'a2ad9231-e827-485f-8a1e-ef4d9a6d5c2e';
    public const INVALID_FORMAT_ERROR = 'a8faedbf-1c2f-4695-8d22-55783be8efed';

    protected const ERROR_NAMES = [
        self::NOT_NUMERIC_ERROR => 'NOT_NUMERIC_ERROR',
        self::INVALID_FORMAT_ERROR => 'INVALID_FORMAT_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'Unsupported card type or invalid card number.';
    public array|string|null $schemes = null;

    /**
     * @param non-empty-string|non-empty-string[]|array<string,mixed>|null $schemes Name(s) of the number scheme(s) used to validate the credit card number
     * @param string[]|null                                                $groups
     * @param array<string,mixed>|null                                     $options
     */
    #[HasNamedArguments]
    public function __construct(array|string|null $schemes, ?string $message = null, ?array $groups = null, mixed $payload = null, ?array $options = null)
    {
        if (\is_array($schemes) && \is_string(key($schemes))) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);

            $options = array_merge($schemes, $options ?? []);
        } else {
            if (\is_array($options)) {
                trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
            } else {
                $options = [];
            }

            if (null !== $schemes) {
                $options['value'] = $schemes;
            }
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'Unsupported card type or invalid card number.';
    public $schemes;

    public function __construct(array|string|null $schemes, ?string $message = null, ?array $groups = null, mixed $payload = null, array $options = [])
    {
        if (\is_array($schemes) && \is_string(key($schemes))) {
            $options = array_merge($schemes, $options);
        } elseif (null !== $schemes) {
            $options['value'] = $schemes;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
    }

    public function getDefaultOption(): ?string
    {
        return 'schemes';
    }

    public function getRequiredOptions(): array
    {
        return ['schemes'];
    }
}
