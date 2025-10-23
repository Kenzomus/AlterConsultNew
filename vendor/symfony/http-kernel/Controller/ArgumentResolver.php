<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver;
<<<<<<< HEAD
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactoryInterface;
use Symfony\Component\HttpKernel\Exception\NearMissValueResolverException;
=======
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\TraceableValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactoryInterface;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\HttpKernel\Exception\ResolverNotFoundException;
use Symfony\Contracts\Service\ServiceProviderInterface;

/**
 * Responsible for resolving the arguments passed to an action.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
final class ArgumentResolver implements ArgumentResolverInterface
{
    private ArgumentMetadataFactoryInterface $argumentMetadataFactory;
    private iterable $argumentValueResolvers;
<<<<<<< HEAD

    /**
     * @param iterable<mixed, ValueResolverInterface> $argumentValueResolvers
     */
    public function __construct(
        ?ArgumentMetadataFactoryInterface $argumentMetadataFactory = null,
        iterable $argumentValueResolvers = [],
        private ?ContainerInterface $namedResolvers = null,
    ) {
        $this->argumentMetadataFactory = $argumentMetadataFactory ?? new ArgumentMetadataFactory();
        $this->argumentValueResolvers = $argumentValueResolvers ?: self::getDefaultArgumentValueResolvers();
=======
    private ?ContainerInterface $namedResolvers;

    /**
     * @param iterable<mixed, ArgumentValueResolverInterface|ValueResolverInterface> $argumentValueResolvers
     */
    public function __construct(?ArgumentMetadataFactoryInterface $argumentMetadataFactory = null, iterable $argumentValueResolvers = [], ?ContainerInterface $namedResolvers = null)
    {
        $this->argumentMetadataFactory = $argumentMetadataFactory ?? new ArgumentMetadataFactory();
        $this->argumentValueResolvers = $argumentValueResolvers ?: self::getDefaultArgumentValueResolvers();
        $this->namedResolvers = $namedResolvers;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getArguments(Request $request, callable $controller, ?\ReflectionFunctionAbstract $reflector = null): array
    {
        $arguments = [];

        foreach ($this->argumentMetadataFactory->createArgumentMetadata($controller, $reflector) as $metadata) {
            $argumentValueResolvers = $this->argumentValueResolvers;
            $disabledResolvers = [];

            if ($this->namedResolvers && $attributes = $metadata->getAttributesOfType(ValueResolver::class, $metadata::IS_INSTANCEOF)) {
                $resolverName = null;
                foreach ($attributes as $attribute) {
                    if ($attribute->disabled) {
                        $disabledResolvers[$attribute->resolver] = true;
                    } elseif ($resolverName) {
<<<<<<< HEAD
                        throw new \LogicException(\sprintf('You can only pin one resolver per argument, but argument "$%s" of "%s()" has more.', $metadata->getName(), $metadata->getControllerName()));
=======
                        throw new \LogicException(\sprintf('You can only pin one resolver per argument, but argument "$%s" of "%s()" has more.', $metadata->getName(), $this->getPrettyName($controller)));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    } else {
                        $resolverName = $attribute->resolver;
                    }
                }

                if ($resolverName) {
                    if (!$this->namedResolvers->has($resolverName)) {
                        throw new ResolverNotFoundException($resolverName, $this->namedResolvers instanceof ServiceProviderInterface ? array_keys($this->namedResolvers->getProvidedServices()) : []);
                    }

                    $argumentValueResolvers = [
                        $this->namedResolvers->get($resolverName),
                        new RequestAttributeValueResolver(),
                        new DefaultValueResolver(),
                    ];
                }
            }

<<<<<<< HEAD
            $valueResolverExceptions = [];
            foreach ($argumentValueResolvers as $name => $resolver) {
=======
            foreach ($argumentValueResolvers as $name => $resolver) {
                if ((!$resolver instanceof ValueResolverInterface || $resolver instanceof TraceableValueResolver) && !$resolver->supports($request, $metadata)) {
                    continue;
                }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                if (isset($disabledResolvers[\is_int($name) ? $resolver::class : $name])) {
                    continue;
                }

<<<<<<< HEAD
                try {
                    $count = 0;
                    foreach ($resolver->resolve($request, $metadata) as $argument) {
                        ++$count;
                        $arguments[] = $argument;
                    }
                } catch (NearMissValueResolverException $e) {
                    $valueResolverExceptions[] = $e;
=======
                $count = 0;
                foreach ($resolver->resolve($request, $metadata) as $argument) {
                    ++$count;
                    $arguments[] = $argument;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                }

                if (1 < $count && !$metadata->isVariadic()) {
                    throw new \InvalidArgumentException(\sprintf('"%s::resolve()" must yield at most one value for non-variadic arguments.', get_debug_type($resolver)));
                }

                if ($count) {
                    // continue to the next controller argument
                    continue 2;
                }
<<<<<<< HEAD
            }

            $reasons = array_map(static fn (NearMissValueResolverException $e) => $e->getMessage(), $valueResolverExceptions);
            if (!$reasons) {
                $reasons[] = 'Either the argument is nullable and no null value has been provided, no default value has been provided or there is a non-optional argument after this one.';
            }

            $reasonCounter = 1;
            if (\count($reasons) > 1) {
                foreach ($reasons as $i => $reason) {
                    $reasons[$i] = $reasonCounter.') '.$reason;
                    ++$reasonCounter;
                }
            }

            throw new \RuntimeException(\sprintf('Controller "%s" requires the "$%s" argument that could not be resolved. '.($reasonCounter > 1 ? 'Possible reasons: ' : '').'%s', $metadata->getControllerName(), $metadata->getName(), implode(' ', $reasons)));
=======

                if (!$resolver instanceof ValueResolverInterface) {
                    throw new \InvalidArgumentException(\sprintf('"%s::resolve()" must yield at least one value.', get_debug_type($resolver)));
                }
            }

            throw new \RuntimeException(\sprintf('Controller "%s" requires that you provide a value for the "$%s" argument. Either the argument is nullable and no null value has been provided, no default value has been provided or there is a non-optional argument after this one.', $this->getPrettyName($controller), $metadata->getName()));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $arguments;
    }

    /**
<<<<<<< HEAD
     * @return iterable<int, ValueResolverInterface>
=======
     * @return iterable<int, ArgumentValueResolverInterface>
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public static function getDefaultArgumentValueResolvers(): iterable
    {
        return [
            new RequestAttributeValueResolver(),
            new RequestValueResolver(),
            new SessionValueResolver(),
            new DefaultValueResolver(),
            new VariadicValueResolver(),
        ];
    }
<<<<<<< HEAD
=======

    private function getPrettyName($controller): string
    {
        if (\is_array($controller)) {
            if (\is_object($controller[0])) {
                $controller[0] = get_debug_type($controller[0]);
            }

            return $controller[0].'::'.$controller[1];
        }

        if (\is_object($controller)) {
            return get_debug_type($controller);
        }

        return $controller;
    }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
