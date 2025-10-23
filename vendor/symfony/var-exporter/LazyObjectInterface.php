<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarExporter;

interface LazyObjectInterface
{
    /**
     * Returns whether the object is initialized.
     *
<<<<<<< HEAD
     * @param bool $partial Whether partially initialized objects should be considered as initialized
=======
     * @param $partial Whether partially initialized objects should be considered as initialized
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function isLazyObjectInitialized(bool $partial = false): bool;

    /**
     * Forces initialization of a lazy object and returns it.
     */
    public function initializeLazyObject(): object;

    /**
     * @return bool Returns false when the object cannot be reset, ie when it's not a lazy object
     */
    public function resetLazyObject(): bool;
}
