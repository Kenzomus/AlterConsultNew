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

<<<<<<< HEAD
use Twig\Error\SyntaxError;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\DeprecatedNode;
use Twig\Node\Node;
use Twig\Token;

/**
 * Deprecates a section of a template.
 *
 *    {% deprecated 'The "base.twig" template is deprecated, use "layout.twig" instead.' %}
 *    {% extends 'layout.html.twig' %}
 *
<<<<<<< HEAD
 *    {% deprecated 'The "base.twig" template is deprecated, use "layout.twig" instead.' package="foo/bar" version="1.1" %}
 *
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 *
 * @internal
 */
final class DeprecatedTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
<<<<<<< HEAD
        $stream = $this->parser->getStream();
        $expr = $this->parser->parseExpression();
        $node = new DeprecatedNode($expr, $token->getLine());

        while ($stream->test(Token::NAME_TYPE)) {
            $k = $stream->getCurrent()->getValue();
            $stream->next();
            $stream->expect(Token::OPERATOR_TYPE, '=');

            switch ($k) {
                case 'package':
                    $node->setNode('package', $this->parser->parseExpression());
                    break;
                case 'version':
                    $node->setNode('version', $this->parser->parseExpression());
                    break;
                default:
                    throw new SyntaxError(\sprintf('Unknown "%s" option.', $k), $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return $node;
=======
        $expr = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        return new DeprecatedNode($expr, $token->getLine(), $this->getTag());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getTag(): string
    {
        return 'deprecated';
    }
}
