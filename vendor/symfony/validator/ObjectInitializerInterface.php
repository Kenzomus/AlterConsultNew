<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator;

/**
 * Prepares an object for validation.
 *
 * Concrete implementations of this interface are used by {@link Validator\ContextualValidatorInterface}
 * to initialize objects just before validating them.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface ObjectInitializerInterface
{
<<<<<<< HEAD
    public function initialize(object $object): void;
=======
    /**
     * @return void
     */
    public function initialize(object $object);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
