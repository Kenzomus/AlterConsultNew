<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Attribute;

use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Attribute to wrap a service in a closure that returns it.
 */
#[\Attribute(\Attribute::TARGET_PARAMETER)]
class AutowireServiceClosure extends Autowire
{
<<<<<<< HEAD
    /**
     * @param string $service The service id to wrap in the closure
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(string $service)
    {
        parent::__construct(new ServiceClosureArgument(new Reference($service)));
    }
}
