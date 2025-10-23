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

namespace Twig;

use Twig\Error\SyntaxError;

/**
 * Represents a token stream.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class TokenStream
{
<<<<<<< HEAD
    private $current = 0;

    public function __construct(
        private array $tokens,
        private ?Source $source = null,
    ) {
        if (null === $this->source) {
            trigger_deprecation('twig/twig', '3.16', \sprintf('Not passing a "%s" object to "%s" constructor is deprecated.', Source::class, __CLASS__));

            $this->source = new Source('', '');
        }
    }

    public function __toString(): string
=======
    private $tokens;
    private $current = 0;
    private $source;

    public function __construct(array $tokens, Source $source = null)
    {
        $this->tokens = $tokens;
        $this->source = $source ?: new Source('', '');
    }

    public function __toString()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return implode("\n", $this->tokens);
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function injectTokens(array $tokens)
    {
        $this->tokens = array_merge(\array_slice($this->tokens, 0, $this->current), $tokens, \array_slice($this->tokens, $this->current));
    }

    /**
     * Sets the pointer to the next token and returns the old one.
     */
    public function next(): Token
    {
        if (!isset($this->tokens[++$this->current])) {
            throw new SyntaxError('Unexpected end of template.', $this->tokens[$this->current - 1]->getLine(), $this->source);
        }

        return $this->tokens[$this->current - 1];
    }

    /**
     * Tests a token, sets the pointer to the next one and returns it or throws a syntax error.
     *
     * @return Token|null The next token if the condition is true, null otherwise
     */
    public function nextIf($primary, $secondary = null)
    {
<<<<<<< HEAD
        return $this->tokens[$this->current]->test($primary, $secondary) ? $this->next() : null;
=======
        if ($this->tokens[$this->current]->test($primary, $secondary)) {
            return $this->next();
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * Tests a token and returns it or throws a syntax error.
     */
<<<<<<< HEAD
    public function expect($type, $value = null, ?string $message = null): Token
=======
    public function expect($type, $value = null, string $message = null): Token
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $token = $this->tokens[$this->current];
        if (!$token->test($type, $value)) {
            $line = $token->getLine();
<<<<<<< HEAD
            throw new SyntaxError(\sprintf('%sUnexpected token "%s"%s ("%s" expected%s).',
                $message ? $message.'. ' : '',
                $token->toEnglish(),
                $token->getValue() ? \sprintf(' of value "%s"', $token->getValue()) : '',
                Token::typeToEnglish($type), $value ? \sprintf(' with value "%s"', $value) : ''),
=======
            throw new SyntaxError(sprintf('%sUnexpected token "%s"%s ("%s" expected%s).',
                $message ? $message.'. ' : '',
                Token::typeToEnglish($token->getType()),
                $token->getValue() ? sprintf(' of value "%s"', $token->getValue()) : '',
                Token::typeToEnglish($type), $value ? sprintf(' with value "%s"', $value) : ''),
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                $line,
                $this->source
            );
        }
        $this->next();

        return $token;
    }

    /**
     * Looks at the next token.
     */
    public function look(int $number = 1): Token
    {
        if (!isset($this->tokens[$this->current + $number])) {
            throw new SyntaxError('Unexpected end of template.', $this->tokens[$this->current + $number - 1]->getLine(), $this->source);
        }

        return $this->tokens[$this->current + $number];
    }

    /**
     * Tests the current token.
     */
    public function test($primary, $secondary = null): bool
    {
        return $this->tokens[$this->current]->test($primary, $secondary);
    }

    /**
     * Checks if end of stream was reached.
     */
    public function isEOF(): bool
    {
<<<<<<< HEAD
        return $this->tokens[$this->current]->test(Token::EOF_TYPE);
=======
        return /* Token::EOF_TYPE */ -1 === $this->tokens[$this->current]->getType();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getCurrent(): Token
    {
        return $this->tokens[$this->current];
    }

<<<<<<< HEAD
=======
    /**
     * Gets the source associated with this stream.
     *
     * @internal
     */
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function getSourceContext(): Source
    {
        return $this->source;
    }
}
