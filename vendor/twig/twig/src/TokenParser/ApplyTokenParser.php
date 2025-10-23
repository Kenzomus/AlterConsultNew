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
use Twig\ExpressionParser\Infix\FilterExpressionParser;
use Twig\Node\Expression\Variable\LocalVariable;
use Twig\Node\Node;
use Twig\Node\Nodes;
=======
use Twig\Node\Expression\TempNameExpression;
use Twig\Node\Node;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\PrintNode;
use Twig\Node\SetNode;
use Twig\Token;

/**
 * Applies filters on a section of a template.
 *
 *   {% apply upper %}
 *      This text becomes uppercase
 *   {% endapply %}
 *
 * @internal
 */
final class ApplyTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
        $lineno = $token->getLine();
<<<<<<< HEAD
        $ref = new LocalVariable(null, $lineno);
        $filter = $ref;
        $op = $this->parser->getEnvironment()->getExpressionParsers()->getByClass(FilterExpressionParser::class);
        while (true) {
            $filter = $op->parse($this->parser, $filter, $this->parser->getCurrentToken());
            if (!$this->parser->getStream()->test(Token::OPERATOR_TYPE, '|')) {
                break;
            }
            $this->parser->getStream()->next();
        }
=======
        $name = $this->parser->getVarName();

        $ref = new TempNameExpression($name, $lineno);
        $ref->setAttribute('always_defined', true);

        $filter = $this->parser->getExpressionParser()->parseFilterExpressionRaw($ref, $this->getTag());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideApplyEnd'], true);
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

<<<<<<< HEAD
        return new Nodes([
            new SetNode(true, $ref, $body, $lineno),
            new PrintNode($filter, $lineno),
        ], $lineno);
=======
        return new Node([
            new SetNode(true, $ref, $body, $lineno, $this->getTag()),
            new PrintNode($filter, $lineno, $this->getTag()),
        ]);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function decideApplyEnd(Token $token): bool
    {
        return $token->test('endapply');
    }

    public function getTag(): string
    {
        return 'apply';
    }
}
