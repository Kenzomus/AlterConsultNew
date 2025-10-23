<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\MetadataInterface;
use Symfony\Contracts\Service\ResetInterface;

/**
 * Collects some data about validator calls.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
class TraceableValidator implements ValidatorInterface, ResetInterface
{
<<<<<<< HEAD
    private array $collectedData = [];

    public function __construct(
        private ValidatorInterface $validator,
        protected readonly ?\Closure $disabled = null,
    ) {
=======
    private ValidatorInterface $validator;
    private array $collectedData = [];

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getCollectedData(): array
    {
        return $this->collectedData;
    }

<<<<<<< HEAD
    public function reset(): void
=======
    /**
     * @return void
     */
    public function reset()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->collectedData = [];
    }

    public function getMetadataFor(mixed $value): MetadataInterface
    {
        return $this->validator->getMetadataFor($value);
    }

    public function hasMetadataFor(mixed $value): bool
    {
        return $this->validator->hasMetadataFor($value);
    }

    public function validate(mixed $value, Constraint|array|null $constraints = null, string|GroupSequence|array|null $groups = null): ConstraintViolationListInterface
    {
        $violations = $this->validator->validate($value, $constraints, $groups);

<<<<<<< HEAD
        if ($this->disabled?->__invoke()) {
            return $violations;
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $trace = debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS, 7);

        $file = $trace[0]['file'];
        $line = $trace[0]['line'];

        for ($i = 1; $i < 7; ++$i) {
            if (isset($trace[$i]['class'], $trace[$i]['function'])
                && 'validate' === $trace[$i]['function']
                && is_a($trace[$i]['class'], ValidatorInterface::class, true)
            ) {
                $file = $trace[$i]['file'];
                $line = $trace[$i]['line'];

                while (++$i < 7) {
                    if (isset($trace[$i]['function'], $trace[$i]['file']) && empty($trace[$i]['class']) && !str_starts_with($trace[$i]['function'], 'call_user_func')) {
                        $file = $trace[$i]['file'];
                        $line = $trace[$i]['line'];

                        break;
                    }
                }
                break;
            }
        }

        $name = str_replace('\\', '/', $file);
        $name = substr($name, strrpos($name, '/') + 1);

        $this->collectedData[] = [
            'caller' => compact('name', 'file', 'line'),
            'context' => compact('value', 'constraints', 'groups'),
            'violations' => iterator_to_array($violations),
        ];

        return $violations;
    }

    public function validateProperty(object $object, string $propertyName, string|GroupSequence|array|null $groups = null): ConstraintViolationListInterface
    {
        return $this->validator->validateProperty($object, $propertyName, $groups);
    }

    public function validatePropertyValue(object|string $objectOrClass, string $propertyName, mixed $value, string|GroupSequence|array|null $groups = null): ConstraintViolationListInterface
    {
        return $this->validator->validatePropertyValue($objectOrClass, $propertyName, $value, $groups);
    }

    public function startContext(): ContextualValidatorInterface
    {
        return $this->validator->startContext();
    }

    public function inContext(ExecutionContextInterface $context): ContextualValidatorInterface
    {
        return $this->validator->inContext($context);
    }
}
