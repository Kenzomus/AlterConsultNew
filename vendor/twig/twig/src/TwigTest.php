<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig;

use Twig\Node\Expression\TestExpression;

/**
 * Represents a template test.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @see https://twig.symfony.com/doc/templates.html#test-operator
 */
<<<<<<< HEAD
final class TwigTest extends AbstractTwigCallable
{
=======
final class TwigTest
{
    private $name;
    private $callable;
    private $options;
    private $arguments = [];

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @param callable|array{class-string, string}|null $callable A callable implementing the test. If null, you need to overwrite the "node_class" option to customize compilation.
     */
    public function __construct(string $name, $callable = null, array $options = [])
    {
<<<<<<< HEAD
        parent::__construct($name, $callable, $options);

        $this->options = array_merge([
            'node_class' => TestExpression::class,
            'one_mandatory_argument' => false,
        ], $this->options);
    }

    public function getType(): string
    {
        return 'test';
    }

    public function needsCharset(): bool
    {
        return false;
    }

    public function needsEnvironment(): bool
    {
        return false;
    }

    public function needsContext(): bool
    {
        return false;
=======
        $this->name = $name;
        $this->callable = $callable;
        $this->options = array_merge([
            'is_variadic' => false,
            'node_class' => TestExpression::class,
            'deprecated' => false,
            'alternative' => null,
            'one_mandatory_argument' => false,
        ], $options);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the callable to execute for this test.
     *
     * @return callable|array{class-string, string}|null
     */
    public function getCallable()
    {
        return $this->callable;
    }

    public function getNodeClass(): string
    {
        return $this->options['node_class'];
    }

    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function isVariadic(): bool
    {
        return (bool) $this->options['is_variadic'];
    }

    public function isDeprecated(): bool
    {
        return (bool) $this->options['deprecated'];
    }

    public function getDeprecatedVersion(): string
    {
        return \is_bool($this->options['deprecated']) ? '' : $this->options['deprecated'];
    }

    public function getAlternative(): ?string
    {
        return $this->options['alternative'];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function hasOneMandatoryArgument(): bool
    {
        return (bool) $this->options['one_mandatory_argument'];
    }
<<<<<<< HEAD

    public function getMinimalNumberOfRequiredArguments(): int
    {
        return parent::getMinimalNumberOfRequiredArguments() + 1;
    }
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
