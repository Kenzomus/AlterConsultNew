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

/**
 * Marks a content as safe.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
class Markup implements \Countable, \JsonSerializable, \Stringable
{
    private $content;
    private ?string $charset;
=======
class Markup implements \Countable, \JsonSerializable
{
    private $content;
    private $charset;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct($content, $charset)
    {
        $this->content = (string) $content;
        $this->charset = $charset;
    }

<<<<<<< HEAD
    public function __toString(): string
=======
    public function __toString()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->content;
    }

<<<<<<< HEAD
    public function getCharset(): string
    {
        return $this->charset;
    }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return mb_strlen($this->content, $this->charset);
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->content;
    }
}
