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

<<<<<<< HEAD
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

/**
 * Checks that at least one of the given constraint is satisfied.
=======
/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Przemysław Bogusz <przemyslaw.bogusz@tubotax.pl>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class AtLeastOneOf extends Composite
{
    public const AT_LEAST_ONE_OF_ERROR = 'f27e6d6c-261a-4056-b391-6673a623531c';

    protected const ERROR_NAMES = [
        self::AT_LEAST_ONE_OF_ERROR => 'AT_LEAST_ONE_OF_ERROR',
    ];

<<<<<<< HEAD
    public array|Constraint $constraints = [];
    public string $message = 'This value should satisfy at least one of the following constraints:';
    public string $messageCollection = 'Each element of this collection should satisfy its own set of constraints.';
    public bool $includeInternalMessages = true;

    /**
     * @param array<Constraint>|array<string,mixed>|null $constraints             An array of validation constraints
     * @param string[]|null                              $groups
     * @param string|null                                $message                 Intro of the failure message that will be followed by the failed constraint(s) message(s)
     * @param string|null                                $messageCollection       Failure message for All and Collection inner constraints
     * @param bool|null                                  $includeInternalMessages Whether to include inner constraint messages (defaults to true)
     */
    #[HasNamedArguments]
    public function __construct(mixed $constraints = null, ?array $groups = null, mixed $payload = null, ?string $message = null, ?string $messageCollection = null, ?bool $includeInternalMessages = null)
    {
        if (\is_array($constraints) && !array_is_list($constraints)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $constraints = [];
    public $message = 'This value should satisfy at least one of the following constraints:';
    public $messageCollection = 'Each element of this collection should satisfy its own set of constraints.';
    public $includeInternalMessages = true;

    public function __construct(mixed $constraints = null, ?array $groups = null, mixed $payload = null, ?string $message = null, ?string $messageCollection = null, ?bool $includeInternalMessages = null)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($constraints ?? [], $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->messageCollection = $messageCollection ?? $this->messageCollection;
        $this->includeInternalMessages = $includeInternalMessages ?? $this->includeInternalMessages;
    }

    public function getDefaultOption(): ?string
    {
        return 'constraints';
    }

    public function getRequiredOptions(): array
    {
        return ['constraints'];
    }

    protected function getCompositeOption(): string
    {
        return 'constraints';
    }
}
