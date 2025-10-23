<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Registers custom mime types guessers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class AddMimeTypeGuesserPass implements CompilerPassInterface
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
        if ($container->has('mime_types')) {
            $definition = $container->findDefinition('mime_types');
            foreach ($container->findTaggedServiceIds('mime.mime_type_guesser', true) as $id => $attributes) {
                $definition->addMethodCall('registerGuesser', [new Reference($id)]);
            }
        }
    }
}
