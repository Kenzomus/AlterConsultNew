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

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class CountValidator extends ConstraintValidator
{
<<<<<<< HEAD
    public function validate(mixed $value, Constraint $constraint): void
=======
    /**
     * @return void
     */
    public function validate(mixed $value, Constraint $constraint)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (!$constraint instanceof Count) {
            throw new UnexpectedTypeException($constraint, Count::class);
        }

        if (null === $value) {
            return;
        }

        if (!\is_array($value) && !$value instanceof \Countable) {
            throw new UnexpectedValueException($value, 'array|\Countable');
        }

        $count = \count($value);

        if (null !== $constraint->max && $count > $constraint->max) {
            $exactlyOptionEnabled = $constraint->min == $constraint->max;

            $this->context->buildViolation($exactlyOptionEnabled ? $constraint->exactMessage : $constraint->maxMessage)
                ->setParameter('{{ count }}', $count)
                ->setParameter('{{ limit }}', $constraint->max)
                ->setInvalidValue($value)
<<<<<<< HEAD
                ->setPlural($constraint->max)
=======
                ->setPlural((int) $constraint->max)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->setCode($exactlyOptionEnabled ? Count::NOT_EQUAL_COUNT_ERROR : Count::TOO_MANY_ERROR)
                ->addViolation();

            return;
        }

        if (null !== $constraint->min && $count < $constraint->min) {
            $exactlyOptionEnabled = $constraint->min == $constraint->max;

            $this->context->buildViolation($exactlyOptionEnabled ? $constraint->exactMessage : $constraint->minMessage)
                ->setParameter('{{ count }}', $count)
                ->setParameter('{{ limit }}', $constraint->min)
                ->setInvalidValue($value)
<<<<<<< HEAD
                ->setPlural($constraint->min)
=======
                ->setPlural((int) $constraint->min)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->setCode($exactlyOptionEnabled ? Count::NOT_EQUAL_COUNT_ERROR : Count::TOO_FEW_ERROR)
                ->addViolation();

            return;
        }

        if (null !== $constraint->divisibleBy) {
            $this->context
                ->getValidator()
                ->inContext($this->context)
                ->validate($count, [
<<<<<<< HEAD
                    new DivisibleBy(
                        value: $constraint->divisibleBy,
                        message: $constraint->divisibleByMessage,
                    ),
=======
                    new DivisibleBy([
                        'value' => $constraint->divisibleBy,
                        'message' => $constraint->divisibleByMessage,
                    ]),
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ], $this->context->getGroup());
        }
    }
}
