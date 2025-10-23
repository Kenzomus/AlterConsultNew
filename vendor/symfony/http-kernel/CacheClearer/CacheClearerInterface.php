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
 * CacheClearerInterface.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
interface CacheClearerInterface
{
    /**
     * Clears any caches necessary.
<<<<<<< HEAD
     */
    public function clear(string $cacheDir): void;
=======
     *
     * @return void
     */
    public function clear(string $cacheDir);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
