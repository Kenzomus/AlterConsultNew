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
 * Exception thrown when a not allowed class method is used in a template.
 *
 * @author Kit Burton-Senior <mail@kitbs.com>
 */
final class SecurityNotAllowedMethodError extends SecurityError
{
<<<<<<< HEAD
    private string $className;
    private string $methodName;
=======
    private $className;
    private $methodName;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct(string $message, string $className, string $methodName)
    {
        parent::__construct($message);
        $this->className = $className;
        $this->methodName = $methodName;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

<<<<<<< HEAD
    public function getMethodName(): string
=======
    public function getMethodName()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->methodName;
    }
}
