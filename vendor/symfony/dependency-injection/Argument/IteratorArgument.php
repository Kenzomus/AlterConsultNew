<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Argument;

/**
 * Represents a collection of values to lazily iterate over.
 *
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class IteratorArgument implements ArgumentInterface
{
    private array $values;

    public function __construct(array $values)
    {
        $this->setValues($values);
    }

    public function getValues(): array
    {
        return $this->values;
    }

<<<<<<< HEAD
    public function setValues(array $values): void
=======
    /**
     * @return void
     */
    public function setValues(array $values)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->values = $values;
    }
}
