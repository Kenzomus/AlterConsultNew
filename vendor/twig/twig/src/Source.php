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
 * Holds information about a non-compiled Twig template.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class Source
{
<<<<<<< HEAD
=======
    private $code;
    private $name;
    private $path;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @param string $code The template source code
     * @param string $name The template logical name
     * @param string $path The filesystem path of the template if any
     */
<<<<<<< HEAD
    public function __construct(
        private string $code,
        private string $name,
        private string $path = '',
    ) {
=======
    public function __construct(string $code, string $name, string $path = '')
    {
        $this->code = $code;
        $this->name = $name;
        $this->path = $path;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
