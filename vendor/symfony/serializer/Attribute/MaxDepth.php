<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Attribute;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;

/**
<<<<<<< HEAD
=======
 * Annotation class for @MaxDepth().
 *
 * @Annotation
 * @NamedArgumentConstructor
 * @Target({"PROPERTY", "METHOD"})
 *
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_PROPERTY)]
class MaxDepth
{
<<<<<<< HEAD
    /**
     * @param int $maxDepth The maximum serialization depth
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(private readonly int $maxDepth)
    {
        if ($maxDepth <= 0) {
            throw new InvalidArgumentException(\sprintf('Parameter given to "%s" must be a positive integer.', static::class));
        }
    }

<<<<<<< HEAD
    public function getMaxDepth(): int
=======
    /**
     * @return int
     */
    public function getMaxDepth()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->maxDepth;
    }
}

if (!class_exists(\Symfony\Component\Serializer\Annotation\MaxDepth::class, false)) {
    class_alias(MaxDepth::class, \Symfony\Component\Serializer\Annotation\MaxDepth::class);
}
