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
 *   {% import 'forms.html.twig' as forms %}
=======
 *   {% import 'forms.html' as forms %}
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @internal
 */
final class ImportTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
<<<<<<< HEAD
        $macro = $this->parser->parseExpression();
        $this->parser->getStream()->expect(Token::NAME_TYPE, 'as');
        $name = $this->parser->getStream()->expect(Token::NAME_TYPE)->getValue();
        $var = new AssignTemplateVariable(new TemplateVariable($name, $token->getLine()), $this->parser->isMainScope());
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $this->parser->addImportedSymbol('template', $name);

        return new ImportNode($macro, $var, $token->getLine());
=======
        $macro = $this->parser->getExpressionParser()->parseExpression();
        $this->parser->getStream()->expect(/* Token::NAME_TYPE */ 5, 'as');
        $var = new AssignNameExpression($this->parser->getStream()->expect(/* Token::NAME_TYPE */ 5)->getValue(), $token->getLine());
        $this->parser->getStream()->expect(/* Token::BLOCK_END_TYPE */ 3);

        $this->parser->addImportedSymbol('template', $var->getAttribute('name'));

        return new ImportNode($macro, $var, $token->getLine(), $this->getTag(), $this->parser->isMainScope());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getTag(): string
    {
        return 'import';
    }
}
