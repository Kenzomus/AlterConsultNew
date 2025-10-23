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

namespace Twig\TokenParser;

<<<<<<< HEAD
use Twig\Node\Expression\AbstractExpression;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\IncludeNode;
use Twig\Node\Node;
use Twig\Token;

/**
 * Includes a template.
 *
<<<<<<< HEAD
 *   {% include 'header.html.twig' %}
 *     Body
 *   {% include 'footer.html.twig' %}
=======
 *   {% include 'header.html' %}
 *     Body
 *   {% include 'footer.html' %}
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @internal
 */
class IncludeTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
<<<<<<< HEAD
        $expr = $this->parser->parseExpression();

        [$variables, $only, $ignoreMissing] = $this->parseArguments();

        return new IncludeNode($expr, $variables, $only, $ignoreMissing, $token->getLine());
    }

    /**
     * @return array{0: ?AbstractExpression, 1: bool, 2: bool}
     */
=======
        $expr = $this->parser->getExpressionParser()->parseExpression();

        list($variables, $only, $ignoreMissing) = $this->parseArguments();

        return new IncludeNode($expr, $variables, $only, $ignoreMissing, $token->getLine(), $this->getTag());
    }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function parseArguments()
    {
        $stream = $this->parser->getStream();

        $ignoreMissing = false;
<<<<<<< HEAD
        if ($stream->nextIf(Token::NAME_TYPE, 'ignore')) {
            $stream->expect(Token::NAME_TYPE, 'missing');
=======
        if ($stream->nextIf(/* Token::NAME_TYPE */ 5, 'ignore')) {
            $stream->expect(/* Token::NAME_TYPE */ 5, 'missing');
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

            $ignoreMissing = true;
        }

        $variables = null;
<<<<<<< HEAD
        if ($stream->nextIf(Token::NAME_TYPE, 'with')) {
            $variables = $this->parser->parseExpression();
        }

        $only = false;
        if ($stream->nextIf(Token::NAME_TYPE, 'only')) {
            $only = true;
        }

        $stream->expect(Token::BLOCK_END_TYPE);
=======
        if ($stream->nextIf(/* Token::NAME_TYPE */ 5, 'with')) {
            $variables = $this->parser->getExpressionParser()->parseExpression();
        }

        $only = false;
        if ($stream->nextIf(/* Token::NAME_TYPE */ 5, 'only')) {
            $only = true;
        }

        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        return [$variables, $only, $ignoreMissing];
    }

    public function getTag(): string
    {
        return 'include';
    }
}
