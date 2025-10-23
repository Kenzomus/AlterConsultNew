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

class RemoveBuildParametersPass implements CompilerPassInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $removedParameters = [];

<<<<<<< HEAD
    public function process(ContainerBuilder $container): void
=======
    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $parameterBag = $container->getParameterBag();
        $this->removedParameters = [];

        foreach ($parameterBag->all() as $name => $value) {
            if ('.' === ($name[0] ?? '')) {
                $this->removedParameters[$name] = $value;

                $parameterBag->remove($name);
                $container->log($this, \sprintf('Removing build parameter "%s".', $name));
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function getRemovedParameters(): array
    {
        return $this->removedParameters;
    }
}
