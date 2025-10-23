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
 * Yields the same instance as the request object passed along.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
<<<<<<< HEAD
final class RequestValueResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        if (Request::class === $argument->getType() || is_subclass_of($argument->getType(), Request::class)) {
            return [$request];
        }

        if (str_ends_with($argument->getType() ?? '', '\\Request')) {
            throw new NearMissValueResolverException(\sprintf('Looks like you required a Request object with the wrong class name "%s". Did you mean to use "%s" instead?', $argument->getType(), Request::class));
        }

        return [];
=======
final class RequestValueResolver implements ArgumentValueResolverInterface, ValueResolverInterface
{
    /**
     * @deprecated since Symfony 6.2, use resolve() instead
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        @trigger_deprecation('symfony/http-kernel', '6.2', 'The "%s()" method is deprecated, use "resolve()" instead.', __METHOD__);

        return Request::class === $argument->getType() || is_subclass_of($argument->getType(), Request::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        return Request::class === $argument->getType() || is_subclass_of($argument->getType(), Request::class) ? [$request] : [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
