<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Sandbox;

/**
 * Exception thrown when a not allowed tag is used in a template.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
final class SecurityNotAllowedTagError extends SecurityError
{
<<<<<<< HEAD
    private string $tagName;
=======
    private $tagName;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct(string $message, string $tagName)
    {
        parent::__construct($message);
        $this->tagName = $tagName;
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }
}
