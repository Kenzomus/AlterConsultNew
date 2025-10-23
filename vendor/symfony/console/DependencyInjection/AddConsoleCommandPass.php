<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\DependencyInjection;

<<<<<<< HEAD
use Symfony\Component\Console\Attribute\AsCommand;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LazyCommand;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\TypedReference;

/**
 * Registers console commands.
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class AddConsoleCommandPass implements CompilerPassInterface
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
        $commandServices = $container->findTaggedServiceIds('console.command', true);
        $lazyCommandMap = [];
        $lazyCommandRefs = [];
        $serviceIds = [];

        foreach ($commandServices as $id => $tags) {
            $definition = $container->getDefinition($id);
<<<<<<< HEAD
            $class = $container->getParameterBag()->resolveValue($definition->getClass());

            if (!$r = $container->getReflectionClass($class)) {
                throw new InvalidArgumentException(\sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
            }

            if (!$r->isSubclassOf(Command::class)) {
                if (!$r->hasMethod('__invoke')) {
                    throw new InvalidArgumentException(\sprintf('The service "%s" tagged "%s" must either be a subclass of "%s" or have an "__invoke()" method.', $id, 'console.command', Command::class));
                }

                $invokableRef = new Reference($id);
                $definition = $container->register($id .= '.command', $class = Command::class)
                    ->addMethodCall('setCode', [$invokableRef]);
            } else {
                $invokableRef = null;
            }

            $definition->addTag('container.no_preload');

            /** @var AsCommand|null $attribute */
            $attribute = ($r->getAttributes(AsCommand::class)[0] ?? null)?->newInstance();

            if (Command::class !== (new \ReflectionMethod($class, 'getDefaultName'))->class) {
                trigger_deprecation('symfony/console', '7.3', 'Overriding "Command::getDefaultName()" in "%s" is deprecated and will be removed in Symfony 8.0, use the #[AsCommand] attribute instead.', $class);

                $defaultName = $class::getDefaultName();
            } else {
                $defaultName = $attribute?->name;
            }

            $aliases = str_replace('%', '%%', $tags[0]['command'] ?? $defaultName ?? '');
            $aliases = explode('|', $aliases);
=======
            $definition->addTag('container.no_preload');
            $class = $container->getParameterBag()->resolveValue($definition->getClass());

            if (isset($tags[0]['command'])) {
                $aliases = $tags[0]['command'];
            } else {
                if (!$r = $container->getReflectionClass($class)) {
                    throw new InvalidArgumentException(\sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
                }
                if (!$r->isSubclassOf(Command::class)) {
                    throw new InvalidArgumentException(\sprintf('The service "%s" tagged "%s" must be a subclass of "%s".', $id, 'console.command', Command::class));
                }
                $aliases = str_replace('%', '%%', $class::getDefaultName() ?? '');
            }

            $aliases = explode('|', $aliases ?? '');
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $commandName = array_shift($aliases);

            if ($isHidden = '' === $commandName) {
                $commandName = array_shift($aliases);
            }

            if (null === $commandName) {
                if (!$definition->isPublic() || $definition->isPrivate() || $definition->hasTag('container.private')) {
                    $commandId = 'console.command.public_alias.'.$id;
                    $container->setAlias($commandId, $id)->setPublic(true);
                    $id = $commandId;
                }
                $serviceIds[] = $id;

                continue;
            }

            $description = $tags[0]['description'] ?? null;
<<<<<<< HEAD
            $help = $tags[0]['help'] ?? null;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

            unset($tags[0]);
            $lazyCommandMap[$commandName] = $id;
            $lazyCommandRefs[$id] = new TypedReference($id, $class);

            foreach ($aliases as $alias) {
                $lazyCommandMap[$alias] = $id;
            }

            foreach ($tags as $tag) {
                if (isset($tag['command'])) {
                    $aliases[] = $tag['command'];
                    $lazyCommandMap[$tag['command']] = $id;
                }

                $description ??= $tag['description'] ?? null;
<<<<<<< HEAD
                $help ??= $tag['help'] ?? null;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            $definition->addMethodCall('setName', [$commandName]);

            if ($aliases) {
                $definition->addMethodCall('setAliases', [$aliases]);
            }

            if ($isHidden) {
                $definition->addMethodCall('setHidden', [true]);
            }

<<<<<<< HEAD
            if ($help && $invokableRef) {
                $definition->addMethodCall('setHelp', [str_replace('%', '%%', $help)]);
            }

            if (!$description) {
                if (Command::class !== (new \ReflectionMethod($class, 'getDefaultDescription'))->class) {
                    trigger_deprecation('symfony/console', '7.3', 'Overriding "Command::getDefaultDescription()" in "%s" is deprecated and will be removed in Symfony 8.0, use the #[AsCommand] attribute instead.', $class);

                    $description = $class::getDefaultDescription();
                } else {
                    $description = $attribute?->description;
                }
            }

            if ($description) {
                $definition->addMethodCall('setDescription', [str_replace('%', '%%', $description)]);
=======
            if (!$description) {
                if (!$r = $container->getReflectionClass($class)) {
                    throw new InvalidArgumentException(\sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
                }
                if (!$r->isSubclassOf(Command::class)) {
                    throw new InvalidArgumentException(\sprintf('The service "%s" tagged "%s" must be a subclass of "%s".', $id, 'console.command', Command::class));
                }
                $description = str_replace('%', '%%', $class::getDefaultDescription() ?? '');
            }

            if ($description) {
                $definition->addMethodCall('setDescription', [$description]);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

                $container->register('.'.$id.'.lazy', LazyCommand::class)
                    ->setArguments([$commandName, $aliases, $description, $isHidden, new ServiceClosureArgument($lazyCommandRefs[$id])]);

                $lazyCommandRefs[$id] = new Reference('.'.$id.'.lazy');
            }
        }

        $container
            ->register('console.command_loader', ContainerCommandLoader::class)
            ->setPublic(true)
            ->addTag('container.no_preload')
            ->setArguments([ServiceLocatorTagPass::register($container, $lazyCommandRefs), $lazyCommandMap]);

        $container->setParameter('console.command.ids', $serviceIds);
    }
}
