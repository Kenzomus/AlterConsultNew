<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * BundleInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface BundleInterface
{
    /**
     * Boots the Bundle.
     *
     * @return void
     */
    public function boot();

    /**
     * Shutdowns the Bundle.
     *
     * @return void
     */
    public function shutdown();

    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * @return void
     */
    public function build(ContainerBuilder $container);

    /**
     * Returns the container extension that should be implicitly loaded.
     */
    public function getContainerExtension(): ?ExtensionInterface;

    /**
     * Returns the bundle name (the class short name).
     */
    public function getName(): string;

    /**
     * Gets the Bundle namespace.
     */
    public function getNamespace(): string;

    /**
     * Gets the Bundle directory path.
     *
     * The path should always be returned as a Unix path (with /).
     */
    public function getPath(): string;

<<<<<<< HEAD
    public function setContainer(?ContainerInterface $container): void;
=======
    /**
     * @return void
     */
    public function setContainer(?ContainerInterface $container);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
