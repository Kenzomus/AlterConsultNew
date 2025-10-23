<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Extension;

/**
<<<<<<< HEAD
 * Allows Twig extensions to add globals to the context.
=======
 * Enables usage of the deprecated Twig\Extension\AbstractExtension::getGlobals() method.
 *
 * Explicitly implement this interface if you really need to implement the
 * deprecated getGlobals() method in your extensions.
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface GlobalsInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getGlobals(): array;
}
