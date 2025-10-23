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

use Twig\Node\Expression\FilterExpression;
use Twig\Node\Node;

/**
 * Represents a template filter.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @see https://twig.symfony.com/doc/templates.html#filters
 */
<<<<<<< HEAD
final class TwigFilter extends AbstractTwigCallable
{
=======
final class TwigFilter
{
    private $name;
    private $callable;
    private $options;
    private $arguments = [];

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @param callable|array{class-string, string}|null $callable A callable implementing the filter. If null, you need to overwrite the "node_class" option to customize compilation.
     */
    public function __construct(string $name, $callable = null, array $options = [])
    {
<<<<<<< HEAD
        parent::__construct($name, $callable, $options);

        $this->options = array_merge([
=======
        $this->name = $name;
        $this->callable = $callable;
        $this->options = array_merge([
            'needs_environment' => false,
            'needs_context' => false,
            'is_variadic' => false,
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            'is_safe' => null,
            'is_safe_callback' => null,
            'pre_escape' => null,
            'preserves_safety' => null,
            'node_class' => FilterExpression::class,
<<<<<<< HEAD
        ], $this->options);
    }

    public function getType(): string
    {
        return 'filter';
=======
            'deprecated' => false,
            'alternative' => null,
        ], $options);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the callable to execute for this filter.
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

    public function needsEnvironment(): bool
    {
        return $this->options['needs_environment'];
    }

    public function needsContext(): bool
    {
        return $this->options['needs_context'];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getSafe(Node $filterArgs): ?array
    {
        if (null !== $this->options['is_safe']) {
            return $this->options['is_safe'];
        }

        if (null !== $this->options['is_safe_callback']) {
            return $this->options['is_safe_callback']($filterArgs);
        }

<<<<<<< HEAD
        return [];
    }

    public function getPreservesSafety(): array
    {
        return $this->options['preserves_safety'] ?? [];
=======
        return null;
    }

    public function getPreservesSafety(): ?array
    {
        return $this->options['preserves_safety'];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getPreEscape(): ?string
    {
        return $this->options['pre_escape'];
    }

<<<<<<< HEAD
    public function getMinimalNumberOfRequiredArguments(): int
    {
        return parent::getMinimalNumberOfRequiredArguments() + 1;
=======
    public function isVariadic(): bool
    {
        return $this->options['is_variadic'];
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
}
