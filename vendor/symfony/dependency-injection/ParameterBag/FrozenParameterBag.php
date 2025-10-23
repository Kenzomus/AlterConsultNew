<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\ParameterBag;

use Symfony\Component\DependencyInjection\Exception\LogicException;

/**
 * Holds read-only parameters.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class FrozenParameterBag extends ParameterBag
{
    /**
     * For performance reasons, the constructor assumes that
     * all keys are already lowercased.
     *
     * This is always the case when used internally.
     */
    public function __construct(
        array $parameters = [],
        protected array $deprecatedParameters = [],
<<<<<<< HEAD
        protected array $nonEmptyParameters = [],
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ) {
        $this->parameters = $parameters;
        $this->resolved = true;
    }

<<<<<<< HEAD
    public function clear(): never
=======
    /**
     * @return never
     */
    public function clear()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new LogicException('Impossible to call clear() on a frozen ParameterBag.');
    }

<<<<<<< HEAD
    public function add(array $parameters): never
=======
    /**
     * @return never
     */
    public function add(array $parameters)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new LogicException('Impossible to call add() on a frozen ParameterBag.');
    }

<<<<<<< HEAD
    public function set(string $name, array|bool|string|int|float|\UnitEnum|null $value): never
=======
    /**
     * @return never
     */
    public function set(string $name, array|bool|string|int|float|\UnitEnum|null $value)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

<<<<<<< HEAD
    public function deprecate(string $name, string $package, string $version, string $message = 'The parameter "%s" is deprecated.'): never
=======
    /**
     * @return never
     */
    public function deprecate(string $name, string $package, string $version, string $message = 'The parameter "%s" is deprecated.')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new LogicException('Impossible to call deprecate() on a frozen ParameterBag.');
    }

<<<<<<< HEAD
    public function cannotBeEmpty(string $name, string $message = 'A non-empty parameter "%s" is required.'): never
    {
        throw new LogicException('Impossible to call cannotBeEmpty() on a frozen ParameterBag.');
    }

    public function remove(string $name): never
=======
    /**
     * @return never
     */
    public function remove(string $name)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new LogicException('Impossible to call remove() on a frozen ParameterBag.');
    }
}
