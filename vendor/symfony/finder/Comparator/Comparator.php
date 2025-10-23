<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Comparator;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Comparator
{
<<<<<<< HEAD
    private string $operator;

    public function __construct(
        private string $target,
        string $operator = '==',
    ) {
=======
    private string $target;
    private string $operator;

    public function __construct(string $target, string $operator = '==')
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if (!\in_array($operator, ['>', '<', '>=', '<=', '==', '!='])) {
            throw new \InvalidArgumentException(\sprintf('Invalid operator "%s".', $operator));
        }

<<<<<<< HEAD
=======
        $this->target = $target;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->operator = $operator;
    }

    /**
     * Gets the target value.
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * Gets the comparison operator.
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * Tests against the target.
     */
    public function test(mixed $test): bool
    {
        return match ($this->operator) {
            '>' => $test > $this->target,
            '>=' => $test >= $this->target,
            '<' => $test < $this->target,
            '<=' => $test <= $this->target,
            '!=' => $test != $this->target,
            default => $test == $this->target,
        };
    }
}
