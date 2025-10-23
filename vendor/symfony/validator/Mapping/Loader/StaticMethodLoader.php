<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Mapping\Loader;

use Symfony\Component\Validator\Exception\MappingException;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Loads validation metadata by calling a static method on the loaded class.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class StaticMethodLoader implements LoaderInterface
{
<<<<<<< HEAD
=======
    protected $methodName;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * Creates a new loader.
     *
     * @param string $methodName The name of the static method to call
     */
<<<<<<< HEAD
    public function __construct(
        protected string $methodName = 'loadValidatorMetadata',
    ) {
=======
    public function __construct(string $methodName = 'loadValidatorMetadata')
    {
        $this->methodName = $methodName;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function loadClassMetadata(ClassMetadata $metadata): bool
    {
        /** @var \ReflectionClass $reflClass */
        $reflClass = $metadata->getReflectionClass();

        if (!$reflClass->isInterface() && $reflClass->hasMethod($this->methodName)) {
            $reflMethod = $reflClass->getMethod($this->methodName);

            if ($reflMethod->isAbstract()) {
                return false;
            }

            if (!$reflMethod->isStatic()) {
                throw new MappingException(\sprintf('The method "%s::%s()" should be static.', $reflClass->name, $this->methodName));
            }

            if ($reflMethod->getDeclaringClass()->name != $reflClass->name) {
                return false;
            }

            $reflMethod->invoke(null, $metadata);

            return true;
        }

        return false;
    }
}
