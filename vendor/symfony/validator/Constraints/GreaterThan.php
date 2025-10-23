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
 * Validates that a value is greater than another value.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class GreaterThan extends AbstractComparison
{
    public const TOO_LOW_ERROR = '778b7ae0-84d3-481a-9dec-35fdb64b1d78';

    protected const ERROR_NAMES = [
        self::TOO_LOW_ERROR => 'TOO_LOW_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value should be greater than {{ compared_value }}.';
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value should be greater than {{ compared_value }}.';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
