<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Sandbox;

/**
 * Exception thrown when a not allowed class property is used in a template.
 *
 * @author Kit Burton-Senior <mail@kitbs.com>
 */
final class SecurityNotAllowedPropertyError extends SecurityError
{
<<<<<<< HEAD
    private string $className;
    private string $propertyName;
=======
    private $className;
    private $propertyName;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct(string $message, string $className, string $propertyName)
    {
        parent::__construct($message);
        $this->className = $className;
        $this->propertyName = $propertyName;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

<<<<<<< HEAD
    public function getPropertyName(): string
=======
    public function getPropertyName()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->propertyName;
    }
}
