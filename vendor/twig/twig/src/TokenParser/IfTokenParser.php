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

use Twig\Error\SyntaxError;
use Twig\Node\IfNode;
use Twig\Node\Node;
<<<<<<< HEAD
use Twig\Node\Nodes;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Token;

/**
 * Tests a condition.
 *
 *   {% if users %}
 *    <ul>
 *      {% for user in users %}
 *        <li>{{ user.username|e }}</li>
 *      {% endfor %}
 *    </ul>
 *   {% endif %}
 *
 * @internal
 */
final class IfTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
        $lineno = $token->getLine();
<<<<<<< HEAD
        $expr = $this->parser->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(Token::BLOCK_END_TYPE);
=======
        $expr = $this->parser->getExpressionParser()->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $body = $this->parser->subparse([$this, 'decideIfFork']);
        $tests = [$expr, $body];
        $else = null;

        $end = false;
        while (!$end) {
            switch ($stream->next()->getValue()) {
                case 'else':
<<<<<<< HEAD
                    $stream->expect(Token::BLOCK_END_TYPE);
=======
                    $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    $else = $this->parser->subparse([$this, 'decideIfEnd']);
                    break;

                case 'elseif':
<<<<<<< HEAD
                    $expr = $this->parser->parseExpression();
                    $stream->expect(Token::BLOCK_END_TYPE);
=======
                    $expr = $this->parser->getExpressionParser()->parseExpression();
                    $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    $body = $this->parser->subparse([$this, 'decideIfFork']);
                    $tests[] = $expr;
                    $tests[] = $body;
                    break;

                case 'endif':
                    $end = true;
                    break;

                default:
<<<<<<< HEAD
                    throw new SyntaxError(\sprintf('Unexpected end of template. Twig was looking for the following tags "else", "elseif", or "endif" to close the "if" block started at line %d).', $lineno), $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return new IfNode(new Nodes($tests), $else, $lineno);
=======
                    throw new SyntaxError(sprintf('Unexpected end of template. Twig was looking for the following tags "else", "elseif", or "endif" to close the "if" block started at line %d).', $lineno), $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }
        }

        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);

        return new IfNode(new Node($tests), $else, $lineno, $this->getTag());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function decideIfFork(Token $token): bool
    {
        return $token->test(['elseif', 'else', 'endif']);
    }

    public function decideIfEnd(Token $token): bool
    {
        return $token->test(['endif']);
    }

    public function getTag(): string
    {
        return 'if';
    }
}
