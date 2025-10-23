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

use Symfony\Component\Intl\Countries;
<<<<<<< HEAD
use Symfony\Component\Validator\Attribute\HasNamedArguments;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\LogicException;

/**
<<<<<<< HEAD
 * Validates a value is a valid ISO 3166-1 alpha-2 country code.
 *
 * @see https://en.wikipedia.org/wiki/ISO_3166-1#Current_codes
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Country extends Constraint
{
    public const NO_SUCH_COUNTRY_ERROR = '8f900c12-61bd-455d-9398-996cd040f7f0';

    protected const ERROR_NAMES = [
        self::NO_SUCH_COUNTRY_ERROR => 'NO_SUCH_COUNTRY_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value is not a valid country.';
    public bool $alpha3 = false;

    /**
     * @param array<string,mixed>|null $options
     * @param bool|null                $alpha3  Whether to check for alpha-3 codes instead of alpha-2 (defaults to false)
     * @param string[]|null            $groups
     *
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3#Current_codes
     */
    #[HasNamedArguments]
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value is not a valid country.';
    public $alpha3 = false;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?bool $alpha3 = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        if (!class_exists(Countries::class)) {
            throw new LogicException('The Intl component is required to use the Country constraint. Try running "composer require symfony/intl".');
        }

<<<<<<< HEAD
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->alpha3 = $alpha3 ?? $this->alpha3;
    }
}
