<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Loader;

use Psr\Container\ContainerInterface;

/**
 * A route loader that executes a service from a PSR-11 container to load the routes.
 *
 * @author Ryan Weaver <ryan@knpuniversity.com>
 */
class ContainerLoader extends ObjectLoader
{
<<<<<<< HEAD
    public function __construct(
        private ContainerInterface $container,
        ?string $env = null,
    ) {
=======
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container, ?string $env = null)
    {
        $this->container = $container;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($env);
    }

    public function supports(mixed $resource, ?string $type = null): bool
    {
        return 'service' === $type && \is_string($resource);
    }

    protected function getObject(string $id): object
    {
        return $this->container->get($id);
    }
}
