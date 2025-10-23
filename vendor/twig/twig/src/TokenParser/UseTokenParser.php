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

use Twig\Error\SyntaxError;
<<<<<<< HEAD
use Twig\Node\EmptyNode;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
use Twig\Node\Nodes;
=======
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Token;

/**
 * Imports blocks defined in another template into the current template.
 *
 *    {% extends "base.html" %}
 *
 *    {% use "blocks.html" %}
 *
 *    {% block title %}{% endblock %}
 *    {% block content %}{% endblock %}
 *
 * @see https://twig.symfony.com/doc/templates.html#horizontal-reuse for details.
 *
 * @internal
 */
final class UseTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
<<<<<<< HEAD
        $template = $this->parser->parseExpression();
=======
        $template = $this->parser->getExpressionParser()->parseExpression();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $stream = $this->parser->getStream();

        if (!$template instanceof ConstantExpression) {
            throw new SyntaxError('The template references in a "use" statement must be a string.', $stream->getCurrent()->getLine(), $stream->getSourceContext());
        }

        $targets = [];
        if ($stream->nextIf('with')) {
            while (true) {
<<<<<<< HEAD
                $name = $stream->expect(Token::NAME_TYPE)->getValue();

                $alias = $name;
                if ($stream->nextIf('as')) {
                    $alias = $stream->expect(Token::NAME_TYPE)->getValue();
=======
                $name = $stream->expect(/* Token::NAME_TYPE */ 5)->getValue();

                $alias = $name;
                if ($stream->nextIf('as')) {
                    $alias = $stream->expect(/* Token::NAME_TYPE */ 5)->getValue();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                }

                $targets[$name] = new ConstantExpression($alias, -1);

<<<<<<< HEAD
                if (!$stream->nextIf(Token::PUNCTUATION_TYPE, ',')) {
=======
                if (!$stream->nextIf(/* Token::PUNCTUATION_TYPE */ 9, ',')) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    break;
                }
            }
        }

<<<<<<< HEAD
        $stream->expect(Token::BLOCK_END_TYPE);

        $this->parser->addTrait(new Nodes(['template' => $template, 'targets' => new Nodes($targets)]));

        return new EmptyNode($token->getLine());
=======
        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);

        $this->parser->addTrait(new Node(['template' => $template, 'targets' => new Node($targets)]));

        return new Node();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getTag(): string
    {
        return 'use';
    }
}
