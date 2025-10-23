<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Yaml\Tag;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 * @author Guilhem N. <egetick@gmail.com>
 */
final class TaggedValue
{
<<<<<<< HEAD
    public function __construct(
        private string $tag,
        private mixed $value,
    ) {
=======
    private string $tag;
    private mixed $value;

    public function __construct(string $tag, mixed $value)
    {
        $this->tag = $tag;
        $this->value = $value;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
