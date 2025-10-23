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
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * Extend this class to create a reusable set of constraints.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
abstract class Compound extends Composite
{
    /** @var Constraint[] */
<<<<<<< HEAD
    public array $constraints = [];

    #[HasNamedArguments]
    public function __construct(mixed $options = null, ?array $groups = null, mixed $payload = null)
=======
    public $constraints = [];

    public function __construct(mixed $options = null)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (isset($options[$this->getCompositeOption()])) {
            throw new ConstraintDefinitionException(\sprintf('You can\'t redefine the "%s" option. Use the "%s::getConstraints()" method instead.', $this->getCompositeOption(), __CLASS__));
        }

        $this->constraints = $this->getConstraints($this->normalizeOptions($options));

<<<<<<< HEAD
        parent::__construct($options, $groups, $payload);
=======
        parent::__construct($options);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    final protected function getCompositeOption(): string
    {
        return 'constraints';
    }

    final public function validatedBy(): string
    {
        return CompoundValidator::class;
    }

    /**
<<<<<<< HEAD
     * @param array<string, mixed> $options
     *
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     * @return Constraint[]
     */
    abstract protected function getConstraints(array $options): array;
}
