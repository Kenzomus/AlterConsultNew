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

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @author Jan Vernieuwe <jan.vernieuwe@phpro.be>
 */
class ValidationFailedException extends RuntimeException
{
<<<<<<< HEAD
    public function __construct(
        private mixed $value,
        private ConstraintViolationListInterface $violations,
    ) {
        parent::__construct($violations);
    }

    public function getValue(): mixed
=======
    private ConstraintViolationListInterface $violations;
    private mixed $value;

    public function __construct(mixed $value, ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;
        $this->value = $value;
        parent::__construct($violations);
    }

    /**
     * @return mixed
     */
    public function getValue()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->value;
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
