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
 * Validates that a value is a negative number or equal to zero.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Jan Schädlich <jan.schaedlich@sensiolabs.de>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class NegativeOrZero extends LessThanOrEqual
{
    use ZeroComparisonConstraintTrait;

<<<<<<< HEAD
    public string $message = 'This value should be either negative or zero.';
=======
    public $message = 'This value should be either negative or zero.';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
