<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Dumper;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Dumper is the abstract class for all built-in dumpers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class Dumper implements DumperInterface
{
<<<<<<< HEAD
    public function __construct(
        protected ContainerBuilder $container,
    ) {
=======
    protected $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
