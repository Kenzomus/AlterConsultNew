<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Node;

<<<<<<< HEAD
use Twig\Attribute\YieldReady;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Compiler;

/**
 * Represents an autoescape node.
 *
 * The value is the escaping strategy (can be html, js, ...)
 *
 * The true value is equivalent to html.
 *
 * If autoescaping is disabled, then the value is false.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
class AutoEscapeNode extends Node
{
    public function __construct($value, Node $body, int $lineno)
    {
        parent::__construct(['body' => $body], ['value' => $value], $lineno);
=======
class AutoEscapeNode extends Node
{
    public function __construct($value, Node $body, int $lineno, string $tag = 'autoescape')
    {
        parent::__construct(['body' => $body], ['value' => $value], $lineno, $tag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function compile(Compiler $compiler): void
    {
        $compiler->subcompile($this->getNode('body'));
    }
}
