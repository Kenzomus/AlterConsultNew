<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\TokenParser;

use Twig\Node\DoNode;
use Twig\Node\Node;
use Twig\Token;

/**
 * Evaluates an expression, discarding the returned value.
 *
 * @internal
 */
final class DoTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
<<<<<<< HEAD
        $expr = $this->parser->parseExpression();

        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        return new DoNode($expr, $token->getLine());
=======
        $expr = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(/* Token::BLOCK_END_TYPE */ 3);

        return new DoNode($expr, $token->getLine(), $this->getTag());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getTag(): string
    {
        return 'do';
    }
}
