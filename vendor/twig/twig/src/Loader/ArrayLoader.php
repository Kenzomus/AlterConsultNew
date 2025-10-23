<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Loader;

use Twig\Error\LoaderError;
use Twig\Source;

/**
 * Loads a template from an array.
 *
 * When using this loader with a cache mechanism, you should know that a new cache
 * key is generated each time a template content "changes" (the cache key being the
 * source code of the template). If you don't want to see your cache grows out of
 * control, you need to take care of clearing the old cache file by yourself.
 *
 * This loader should only be used for unit testing.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class ArrayLoader implements LoaderInterface
{
<<<<<<< HEAD
    /**
     * @param array $templates An array of templates (keys are the names, and values are the source code)
     */
    public function __construct(
        private array $templates = [],
    ) {
=======
    private $templates = [];

    /**
     * @param array $templates An array of templates (keys are the names, and values are the source code)
     */
    public function __construct(array $templates = [])
    {
        $this->templates = $templates;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function setTemplate(string $name, string $template): void
    {
        $this->templates[$name] = $template;
    }

    public function getSourceContext(string $name): Source
    {
        if (!isset($this->templates[$name])) {
<<<<<<< HEAD
            throw new LoaderError(\sprintf('Template "%s" is not defined.', $name));
=======
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return new Source($this->templates[$name], $name);
    }

    public function exists(string $name): bool
    {
        return isset($this->templates[$name]);
    }

    public function getCacheKey(string $name): string
    {
        if (!isset($this->templates[$name])) {
<<<<<<< HEAD
            throw new LoaderError(\sprintf('Template "%s" is not defined.', $name));
=======
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $name.':'.$this->templates[$name];
    }

    public function isFresh(string $name, int $time): bool
    {
        if (!isset($this->templates[$name])) {
<<<<<<< HEAD
            throw new LoaderError(\sprintf('Template "%s" is not defined.', $name));
=======
            throw new LoaderError(sprintf('Template "%s" is not defined.', $name));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return true;
    }
}
