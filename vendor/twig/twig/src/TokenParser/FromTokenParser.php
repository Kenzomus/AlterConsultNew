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
use Twig\Node\Expression\Variable\AssignContextVariable;
use Twig\Node\Expression\Variable\AssignTemplateVariable;
use Twig\Node\Expression\Variable\TemplateVariable;
=======
use Twig\Node\Expression\AssignNameExpression;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Node\ImportNode;
use Twig\Node\Node;
use Twig\Token;

/**
 * Imports macros.
 *
<<<<<<< HEAD
 *   {% from 'forms.html.twig' import forms %}
=======
 *   {% from 'forms.html' import forms %}
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @internal
 */
final class FromTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
<<<<<<< HEAD
        $macro = $this->parser->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(Token::NAME_TYPE, 'import');

        $targets = [];
        while (true) {
            $name = $stream->expect(Token::NAME_TYPE)->getValue();

            if ($stream->nextIf('as')) {
                $alias = new AssignContextVariable($stream->expect(Token::NAME_TYPE)->getValue(), $token->getLine());
            } else {
                $alias = new AssignContextVariable($name, $token->getLine());
=======
        $macro = $this->parser->getExpressionParser()->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(/* Token::NAME_TYPE */ 5, 'import');

        $targets = [];
        while (true) {
            $name = $stream->expect(/* Token::NAME_TYPE */ 5)->getValue();

            $alias = $name;
            if ($stream->nextIf('as')) {
                $alias = $stream->expect(/* Token::NAME_TYPE */ 5)->getValue();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            $targets[$name] = $alias;

<<<<<<< HEAD
            if (!$stream->nextIf(Token::PUNCTUATION_TYPE, ',')) {
=======
            if (!$stream->nextIf(/* Token::PUNCTUATION_TYPE */ 9, ',')) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                break;
            }
        }

<<<<<<< HEAD
        $stream->expect(Token::BLOCK_END_TYPE);

        $internalRef = new AssignTemplateVariable(new TemplateVariable(null, $token->getLine()), $this->parser->isMainScope());
        $node = new ImportNode($macro, $internalRef, $token->getLine());

        foreach ($targets as $name => $alias) {
            $this->parser->addImportedSymbol('function', $alias->getAttribute('name'), 'macro_'.$name, $internalRef);
=======
        $stream->expect(/* Token::BLOCK_END_TYPE */ 3);

        $var = new AssignNameExpression($this->parser->getVarName(), $token->getLine());
        $node = new ImportNode($macro, $var, $token->getLine(), $this->getTag(), $this->parser->isMainScope());

        foreach ($targets as $name => $alias) {
            $this->parser->addImportedSymbol('function', $alias, 'macro_'.$name, $var);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $node;
    }

    public function getTag(): string
    {
        return 'from';
    }
}
