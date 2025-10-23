<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Node\Expression;

use Twig\Compiler;

<<<<<<< HEAD
/**
 * @final
 */
class ConstantExpression extends AbstractExpression implements SupportDefinedTestInterface, ReturnPrimitiveTypeInterface
{
    use SupportDefinedTestTrait;

=======
class ConstantExpression extends AbstractExpression
{
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct($value, int $lineno)
    {
        parent::__construct([], ['value' => $value], $lineno);
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
        $compiler->repr($this->definedTest ? true : $this->getAttribute('value'));
=======
        $compiler->repr($this->getAttribute('value'));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
