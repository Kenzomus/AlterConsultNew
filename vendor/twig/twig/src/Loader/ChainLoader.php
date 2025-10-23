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
 * Loads templates from other loaders.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class ChainLoader implements LoaderInterface
{
<<<<<<< HEAD
    /**
     * @var array<string, bool>
     */
    private $hasSourceCache = [];

    /**
     * @param iterable<LoaderInterface> $loaders
     */
    public function __construct(
        private iterable $loaders = [],
    ) {
=======
    private $hasSourceCache = [];
    private $loaders = [];

    /**
     * @param LoaderInterface[] $loaders
     */
    public function __construct(array $loaders = [])
    {
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function addLoader(LoaderInterface $loader): void
    {
<<<<<<< HEAD
        $current = $this->loaders;

        $this->loaders = (static function () use ($current, $loader): \Generator {
            yield from $current;
            yield $loader;
        })();

=======
        $this->loaders[] = $loader;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->hasSourceCache = [];
    }

    /**
     * @return LoaderInterface[]
     */
    public function getLoaders(): array
    {
<<<<<<< HEAD
        if (!\is_array($this->loaders)) {
            $this->loaders = iterator_to_array($this->loaders, false);
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        return $this->loaders;
    }

    public function getSourceContext(string $name): Source
    {
        $exceptions = [];
<<<<<<< HEAD

        foreach ($this->getLoaders() as $loader) {
=======
        foreach ($this->loaders as $loader) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            if (!$loader->exists($name)) {
                continue;
            }

            try {
                return $loader->getSourceContext($name);
            } catch (LoaderError $e) {
                $exceptions[] = $e->getMessage();
            }
        }

<<<<<<< HEAD
        throw new LoaderError(\sprintf('Template "%s" is not defined%s.', $name, $exceptions ? ' ('.implode(', ', $exceptions).')' : ''));
=======
        throw new LoaderError(sprintf('Template "%s" is not defined%s.', $name, $exceptions ? ' ('.implode(', ', $exceptions).')' : ''));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function exists(string $name): bool
    {
        if (isset($this->hasSourceCache[$name])) {
            return $this->hasSourceCache[$name];
        }

<<<<<<< HEAD
        foreach ($this->getLoaders() as $loader) {
=======
        foreach ($this->loaders as $loader) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            if ($loader->exists($name)) {
                return $this->hasSourceCache[$name] = true;
            }
        }

        return $this->hasSourceCache[$name] = false;
    }

    public function getCacheKey(string $name): string
    {
        $exceptions = [];
<<<<<<< HEAD

        foreach ($this->getLoaders() as $loader) {
=======
        foreach ($this->loaders as $loader) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            if (!$loader->exists($name)) {
                continue;
            }

            try {
                return $loader->getCacheKey($name);
            } catch (LoaderError $e) {
<<<<<<< HEAD
                $exceptions[] = $loader::class.': '.$e->getMessage();
            }
        }

        throw new LoaderError(\sprintf('Template "%s" is not defined%s.', $name, $exceptions ? ' ('.implode(', ', $exceptions).')' : ''));
=======
                $exceptions[] = \get_class($loader).': '.$e->getMessage();
            }
        }

        throw new LoaderError(sprintf('Template "%s" is not defined%s.', $name, $exceptions ? ' ('.implode(', ', $exceptions).')' : ''));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function isFresh(string $name, int $time): bool
    {
        $exceptions = [];
<<<<<<< HEAD

        foreach ($this->getLoaders() as $loader) {
=======
        foreach ($this->loaders as $loader) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            if (!$loader->exists($name)) {
                continue;
            }

            try {
                return $loader->isFresh($name, $time);
            } catch (LoaderError $e) {
<<<<<<< HEAD
                $exceptions[] = $loader::class.': '.$e->getMessage();
            }
        }

        throw new LoaderError(\sprintf('Template "%s" is not defined%s.', $name, $exceptions ? ' ('.implode(', ', $exceptions).')' : ''));
=======
                $exceptions[] = \get_class($loader).': '.$e->getMessage();
            }
        }

        throw new LoaderError(sprintf('Template "%s" is not defined%s.', $name, $exceptions ? ' ('.implode(', ', $exceptions).')' : ''));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
