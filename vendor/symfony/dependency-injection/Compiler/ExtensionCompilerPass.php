<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * A pass to automatically process extensions if they implement
 * CompilerPassInterface.
 *
 * @author Wouter J <wouter@wouterj.nl>
 */
class ExtensionCompilerPass implements CompilerPassInterface
{
<<<<<<< HEAD
    public function process(ContainerBuilder $container): void
=======
    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach ($container->getExtensions() as $extension) {
            if (!$extension instanceof CompilerPassInterface) {
                continue;
            }

            $extension->process($container);
        }
    }
}
