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
 * Validates that a value is identical to another value.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Daniel Holmes <daniel@danielholmes.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class IdenticalTo extends AbstractComparison
{
    public const NOT_IDENTICAL_ERROR = '2a8cc50f-58a2-4536-875e-060a2ce69ed5';

    protected const ERROR_NAMES = [
        self::NOT_IDENTICAL_ERROR => 'NOT_IDENTICAL_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value should be identical to {{ compared_value_type }} {{ compared_value }}.';
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value should be identical to {{ compared_value_type }} {{ compared_value }}.';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
