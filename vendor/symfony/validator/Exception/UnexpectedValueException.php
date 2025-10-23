<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Exception;

/**
 * @author Christian Flothmann <christian.flothmann@sensiolabs.de>
 */
class UnexpectedValueException extends UnexpectedTypeException
{
<<<<<<< HEAD
    public function __construct(
        mixed $value,
        private string $expectedType,
    ) {
        parent::__construct($value, $expectedType);
=======
    private string $expectedType;

    public function __construct(mixed $value, string $expectedType)
    {
        parent::__construct($value, $expectedType);

        $this->expectedType = $expectedType;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getExpectedType(): string
    {
        return $this->expectedType;
    }
}
