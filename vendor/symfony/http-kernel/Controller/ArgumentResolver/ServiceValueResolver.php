<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Controller\ArgumentResolver;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Request;
<<<<<<< HEAD
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\NearMissValueResolverException;
=======
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Yields a service keyed by _controller and argument name.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
<<<<<<< HEAD
final class ServiceValueResolver implements ValueResolverInterface
{
    public function __construct(
        private ContainerInterface $container,
    ) {
=======
final class ServiceValueResolver implements ArgumentValueResolverInterface, ValueResolverInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @deprecated since Symfony 6.2, use resolve() instead
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        @trigger_deprecation('symfony/http-kernel', '6.2', 'The "%s()" method is deprecated, use "resolve()" instead.', __METHOD__);

        $controller = $request->attributes->get('_controller');

        if (\is_array($controller) && \is_callable($controller, true) && \is_string($controller[0])) {
            $controller = $controller[0].'::'.$controller[1];
        } elseif (!\is_string($controller) || '' === $controller) {
            return false;
        }

        if ('\\' === $controller[0]) {
            $controller = ltrim($controller, '\\');
        }

        if (!$this->container->has($controller) && false !== $i = strrpos($controller, ':')) {
            $controller = substr($controller, 0, $i).strtolower(substr($controller, $i));
        }

        return $this->container->has($controller) && $this->container->get($controller)->has($argument->getName());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        $controller = $request->attributes->get('_controller');

        if (\is_array($controller) && \is_callable($controller, true) && \is_string($controller[0])) {
            $controller = $controller[0].'::'.$controller[1];
        } elseif (!\is_string($controller) || '' === $controller) {
            return [];
        }

        if ('\\' === $controller[0]) {
            $controller = ltrim($controller, '\\');
        }

        if (!$this->container->has($controller) && false !== $i = strrpos($controller, ':')) {
            $controller = substr($controller, 0, $i).strtolower(substr($controller, $i));
        }

        if (!$this->container->has($controller) || !$this->container->get($controller)->has($argument->getName())) {
            return [];
        }

        try {
            return [$this->container->get($controller)->get($argument->getName())];
        } catch (RuntimeException $e) {
<<<<<<< HEAD
            $what = 'argument $'.$argument->getName();
            $message = str_replace(\sprintf('service "%s"', $argument->getName()), $what, $e->getMessage());
            $what .= \sprintf(' of "%s()"', $controller);
            $message = preg_replace('/service "\.service_locator\.[^"]++"/', $what, $message);
=======
            $what = \sprintf('argument $%s of "%s()"', $argument->getName(), $controller);
            $message = preg_replace('/service "\.service_locator\.[^"]++"/', $what, $e->getMessage());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

            if ($e->getMessage() === $message) {
                $message = \sprintf('Cannot resolve %s: %s', $what, $message);
            }

<<<<<<< HEAD
            throw new NearMissValueResolverException($message, $e->getCode(), $e);
=======
            $r = new \ReflectionProperty($e, 'message');
            $r->setValue($e, $message);

            throw $e;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }
    }
}
