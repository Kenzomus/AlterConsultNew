<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DependencyInjection;

use ProxyManager\Proxy\LazyLoadingInterface;
use Symfony\Component\VarExporter\LazyObjectInterface;
<<<<<<< HEAD
=======
use Symfony\Contracts\Service\ResetInterface;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Resets provided services.
 *
 * @author Alexander M. Turek <me@derrabus.de>
 * @author Nicolas Grekas <p@tchwork.com>
 *
<<<<<<< HEAD
 * @final since Symfony 7.2
 */
class ServicesResetter implements ServicesResetterInterface
{
=======
 * @internal
 */
class ServicesResetter implements ResetInterface
{
    private \Traversable $resettableServices;
    private array $resetMethods;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @param \Traversable<string, object>   $resettableServices
     * @param array<string, string|string[]> $resetMethods
     */
<<<<<<< HEAD
    public function __construct(
        private \Traversable $resettableServices,
        private array $resetMethods,
    ) {
=======
    public function __construct(\Traversable $resettableServices, array $resetMethods)
    {
        $this->resettableServices = $resettableServices;
        $this->resetMethods = $resetMethods;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function reset(): void
    {
        foreach ($this->resettableServices as $id => $service) {
            if ($service instanceof LazyObjectInterface && !$service->isLazyObjectInitialized(true)) {
                continue;
            }

            if ($service instanceof LazyLoadingInterface && !$service->isProxyInitialized()) {
                continue;
            }

<<<<<<< HEAD
            if (\PHP_VERSION_ID >= 80400 && (new \ReflectionClass($service))->isUninitializedLazyObject($service)) {
                continue;
            }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            foreach ((array) $this->resetMethods[$id] as $resetMethod) {
                if ('?' === $resetMethod[0] && !method_exists($service, $resetMethod = substr($resetMethod, 1))) {
                    continue;
                }

                $service->$resetMethod();
            }
        }
    }
}
