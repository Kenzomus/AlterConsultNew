<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\CacheClearer;

/**
 * ChainCacheClearer.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 *
 * @final
 */
class ChainCacheClearer implements CacheClearerInterface
{
<<<<<<< HEAD
    /**
     * @param iterable<mixed, CacheClearerInterface> $clearers
     */
    public function __construct(
        private iterable $clearers = [],
    ) {
=======
    private iterable $clearers;

    /**
     * @param iterable<mixed, CacheClearerInterface> $clearers
     */
    public function __construct(iterable $clearers = [])
    {
        $this->clearers = $clearers;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function clear(string $cacheDir): void
    {
        foreach ($this->clearers as $clearer) {
            $clearer->clear($cacheDir);
        }
    }
}
