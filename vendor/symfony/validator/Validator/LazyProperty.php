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

/**
 * A wrapper for a callable initializing a property from a getter.
 *
 * @internal
 */
class LazyProperty
{
<<<<<<< HEAD
    public function __construct(
        private \Closure $propertyValueCallback,
    ) {
=======
    private \Closure $propertyValueCallback;

    public function __construct(\Closure $propertyValueCallback)
    {
        $this->propertyValueCallback = $propertyValueCallback;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getPropertyValue(): mixed
    {
        return ($this->propertyValueCallback)();
    }
}
