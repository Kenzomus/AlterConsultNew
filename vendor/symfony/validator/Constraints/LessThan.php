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

/**
<<<<<<< HEAD
 * Validates that a value is less than another value.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class LessThan extends AbstractComparison
{
    public const TOO_HIGH_ERROR = '079d7420-2d13-460c-8756-de810eeb37d2';

    protected const ERROR_NAMES = [
        self::TOO_HIGH_ERROR => 'TOO_HIGH_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value should be less than {{ compared_value }}.';
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value should be less than {{ compared_value }}.';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
