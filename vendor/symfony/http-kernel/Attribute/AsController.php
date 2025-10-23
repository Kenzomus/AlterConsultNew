<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Attribute;

/**
 * Autoconfigures controllers as services by applying
 * the `controller.service_arguments` tag to them.
 *
 * This enables injecting services as method arguments in addition
 * to other conventional dependency injection strategies.
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_FUNCTION)]
class AsController
{
<<<<<<< HEAD
=======
    public function __construct()
    {
    }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
