<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Attribute;

/**
<<<<<<< HEAD
=======
 * Annotation class for @Route().
 *
 * @Annotation
 * @NamedArgumentConstructor
 * @Target({"CLASS", "METHOD"})
 *
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Alexander M. Turek <me@derrabus.de>
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
class Route
{
    private ?string $path = null;
    private array $localizedPaths = [];
    private array $methods;
    private array $schemes;
<<<<<<< HEAD
    /**
     * @var (string|DeprecatedAlias)[]
     */
    private array $aliases = [];

    /**
     * @param string|array<string,string>|null                  $path         The route path (i.e. "/user/login")
     * @param string|null                                       $name         The route name (i.e. "app_user_login")
     * @param array<string|\Stringable>                         $requirements Requirements for the route attributes, @see https://symfony.com/doc/current/routing.html#parameters-validation
     * @param array<string, mixed>                              $options      Options for the route (i.e. ['prefix' => '/api'])
     * @param array<string, mixed>                              $defaults     Default values for the route attributes and query parameters
     * @param string|null                                       $host         The host for which this route should be active (i.e. "localhost")
     * @param string|string[]                                   $methods      The list of HTTP methods allowed by this route
     * @param string|string[]                                   $schemes      The list of schemes allowed by this route (i.e. "https")
     * @param string|null                                       $condition    An expression that must evaluate to true for the route to be matched, @see https://symfony.com/doc/current/routing.html#matching-expressions
     * @param int|null                                          $priority     The priority of the route if multiple ones are defined for the same path
     * @param string|null                                       $locale       The locale accepted by the route
     * @param string|null                                       $format       The format returned by the route (i.e. "json", "xml")
     * @param bool|null                                         $utf8         Whether the route accepts UTF-8 in its parameters
     * @param bool|null                                         $stateless    Whether the route is defined as stateless or stateful, @see https://symfony.com/doc/current/routing.html#stateless-routes
     * @param string|null                                       $env          The env in which the route is defined (i.e. "dev", "test", "prod")
     * @param string|DeprecatedAlias|(string|DeprecatedAlias)[] $alias        The list of aliases for this route
=======

    /**
     * @param array<string|\Stringable> $requirements
     * @param string[]|string           $methods
     * @param string[]|string           $schemes
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function __construct(
        string|array|null $path = null,
        private ?string $name = null,
        private array $requirements = [],
        private array $options = [],
        private array $defaults = [],
        private ?string $host = null,
        array|string $methods = [],
        array|string $schemes = [],
        private ?string $condition = null,
        private ?int $priority = null,
        ?string $locale = null,
        ?string $format = null,
        ?bool $utf8 = null,
        ?bool $stateless = null,
        private ?string $env = null,
<<<<<<< HEAD
        string|DeprecatedAlias|array $alias = [],
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ) {
        if (\is_array($path)) {
            $this->localizedPaths = $path;
        } else {
            $this->path = $path;
        }
        $this->setMethods($methods);
        $this->setSchemes($schemes);
<<<<<<< HEAD
        $this->setAliases($alias);
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        if (null !== $locale) {
            $this->defaults['_locale'] = $locale;
        }

        if (null !== $format) {
            $this->defaults['_format'] = $format;
        }

        if (null !== $utf8) {
            $this->options['utf8'] = $utf8;
        }

        if (null !== $stateless) {
            $this->defaults['_stateless'] = $stateless;
        }
    }

<<<<<<< HEAD
    public function setPath(string $path): void
=======
    /**
     * @return void
     */
    public function setPath(string $path)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->path = $path;
    }

<<<<<<< HEAD
    public function getPath(): ?string
=======
    /**
     * @return string|null
     */
    public function getPath()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->path;
    }

<<<<<<< HEAD
    public function setLocalizedPaths(array $localizedPaths): void
=======
    /**
     * @return void
     */
    public function setLocalizedPaths(array $localizedPaths)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->localizedPaths = $localizedPaths;
    }

    public function getLocalizedPaths(): array
    {
        return $this->localizedPaths;
    }

<<<<<<< HEAD
    public function setHost(string $pattern): void
=======
    /**
     * @return void
     */
    public function setHost(string $pattern)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->host = $pattern;
    }

<<<<<<< HEAD
    public function getHost(): ?string
=======
    /**
     * @return string|null
     */
    public function getHost()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->host;
    }

<<<<<<< HEAD
    public function setName(string $name): void
=======
    /**
     * @return void
     */
    public function setName(string $name)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->name = $name;
    }

<<<<<<< HEAD
    public function getName(): ?string
=======
    /**
     * @return string|null
     */
    public function getName()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->name;
    }

<<<<<<< HEAD
    public function setRequirements(array $requirements): void
=======
    /**
     * @return void
     */
    public function setRequirements(array $requirements)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->requirements = $requirements;
    }

<<<<<<< HEAD
    public function getRequirements(): array
=======
    /**
     * @return array
     */
    public function getRequirements()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->requirements;
    }

<<<<<<< HEAD
    public function setOptions(array $options): void
=======
    /**
     * @return void
     */
    public function setOptions(array $options)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->options = $options;
    }

<<<<<<< HEAD
    public function getOptions(): array
=======
    /**
     * @return array
     */
    public function getOptions()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->options;
    }

<<<<<<< HEAD
    public function setDefaults(array $defaults): void
=======
    /**
     * @return void
     */
    public function setDefaults(array $defaults)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->defaults = $defaults;
    }

<<<<<<< HEAD
    public function getDefaults(): array
=======
    /**
     * @return array
     */
    public function getDefaults()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->defaults;
    }

<<<<<<< HEAD
    public function setSchemes(array|string $schemes): void
=======
    /**
     * @return void
     */
    public function setSchemes(array|string $schemes)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->schemes = (array) $schemes;
    }

<<<<<<< HEAD
    public function getSchemes(): array
=======
    /**
     * @return array
     */
    public function getSchemes()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->schemes;
    }

<<<<<<< HEAD
    public function setMethods(array|string $methods): void
=======
    /**
     * @return void
     */
    public function setMethods(array|string $methods)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->methods = (array) $methods;
    }

<<<<<<< HEAD
    public function getMethods(): array
=======
    /**
     * @return array
     */
    public function getMethods()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->methods;
    }

<<<<<<< HEAD
    public function setCondition(?string $condition): void
=======
    /**
     * @return void
     */
    public function setCondition(?string $condition)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->condition = $condition;
    }

<<<<<<< HEAD
    public function getCondition(): ?string
=======
    /**
     * @return string|null
     */
    public function getCondition()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->condition;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setEnv(?string $env): void
    {
        $this->env = $env;
    }

    public function getEnv(): ?string
    {
        return $this->env;
    }
<<<<<<< HEAD

    /**
     * @return (string|DeprecatedAlias)[]
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @param string|DeprecatedAlias|(string|DeprecatedAlias)[] $aliases
     */
    public function setAliases(string|DeprecatedAlias|array $aliases): void
    {
        $this->aliases = \is_array($aliases) ? $aliases : [$aliases];
    }
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}

if (!class_exists(\Symfony\Component\Routing\Annotation\Route::class, false)) {
    class_alias(Route::class, \Symfony\Component\Routing\Annotation\Route::class);
}
