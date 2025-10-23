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
use Twig\Node\IncludeNode;
use Twig\Node\Node;
use Twig\Node\SandboxNode;
use Twig\Node\TextNode;
use Twig\Token;

/**
 * Marks a section of a template as untrusted code that must be evaluated in the sandbox mode.
 *
 *    {% sandbox %}
<<<<<<< HEAD
 *        {% include 'user.html.twig' %}
=======
 *        {% include 'user.html' %}
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *    {% endsandbox %}
 *
 * @see https://twig.symfony.com/doc/api.html#sandbox-extension for details
 *
 * @internal
 */
final class SandboxTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
        $stream = $this->parser->getStream();
<<<<<<< HEAD
        trigger_deprecation('twig/twig', '3.15', \sprintf('The "sandbox" tag is deprecated in "%s" at line %d.', $stream->getSourceContext()->getName(), $token->getLine()));

        $stream->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], true);
        $stream->expect(Token::BLOCK_END_TYPE);
=======
        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], true);
        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        // in a sandbox tag, only include tags are allowed
        if (!$body instanceof IncludeNode) {
            foreach ($body as $node) {
                if ($node instanceof TextNode && ctype_space($node->getAttribute('data'))) {
                    continue;
                }

                if (!$node instanceof IncludeNode) {
                    throw new SyntaxError('Only "include" tags are allowed within a "sandbox" section.', $node->getTemplateLine(), $stream->getSourceContext());
                }
            }
        }

<<<<<<< HEAD
        return new SandboxNode($body, $token->getLine());
=======
        return new SandboxNode($body, $token->getLine(), $this->getTag());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function decideBlockEnd(Token $token): bool
    {
        return $token->test('endsandbox');
    }

    public function getTag(): string
    {
        return 'sandbox';
    }
}
