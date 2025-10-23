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
 * @author Yevgeniy Zholkevskiy <zhenya.zholkevskiy@gmail.com>
 */
class UniqueValidator extends ConstraintValidator
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
        if (!$constraint instanceof Unique) {
            throw new UnexpectedTypeException($constraint, Unique::class);
        }

        $fields = (array) $constraint->fields;

        if (null === $value) {
            return;
        }

        if (!\is_array($value) && !$value instanceof \IteratorAggregate) {
            throw new UnexpectedValueException($value, 'array|IteratorAggregate');
        }

        $collectionElements = [];
        $normalizer = $this->getNormalizer($constraint);
<<<<<<< HEAD
        foreach ($value as $index => $element) {
=======
        foreach ($value as $element) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $element = $normalizer($element);

            if ($fields && !$element = $this->reduceElementKeys($fields, $element)) {
                continue;
            }

<<<<<<< HEAD
            if (!\in_array($element, $collectionElements, true)) {
                $collectionElements[] = $element;
                continue;
            }

            $violationBuilder = $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($element))
                ->setCode(Unique::IS_NOT_UNIQUE);

            if (!$constraint->stopOnFirstError || null !== $constraint->errorPath) {
                $violationBuilder->atPath("[$index]".(null !== $constraint->errorPath ? ".{$constraint->errorPath}" : ''));
            }

            $violationBuilder->addViolation();

            if ($constraint->stopOnFirstError) {
                return;
            }
=======
            if (\in_array($element, $collectionElements, true)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($element))
                    ->setCode(Unique::IS_NOT_UNIQUE)
                    ->addViolation();

                return;
            }
            $collectionElements[] = $element;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }
    }

    private function getNormalizer(Unique $unique): callable
    {
<<<<<<< HEAD
        return $unique->normalizer ?? static fn ($value) => $value;
=======
        if (null === $unique->normalizer) {
            return static fn ($value) => $value;
        }

        return $unique->normalizer;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    private function reduceElementKeys(array $fields, array $element): array
    {
        $output = [];
        foreach ($fields as $field) {
            if (!\is_string($field)) {
                throw new UnexpectedTypeException($field, 'string');
            }
            if (\array_key_exists($field, $element)) {
                $output[$field] = $element[$field];
            }
        }

        return $output;
    }
}
