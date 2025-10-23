<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Profiler;

use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

/**
 * Profile.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Profile
{
<<<<<<< HEAD
=======
    private string $token;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @var DataCollectorInterface[]
     */
    private array $collectors = [];

    private ?string $ip = null;
    private ?string $method = null;
    private ?string $url = null;
    private ?int $time = null;
    private ?int $statusCode = null;
    private ?self $parent = null;
    private ?string $virtualType = null;

    /**
     * @var Profile[]
     */
    private array $children = [];

<<<<<<< HEAD
    public function __construct(
        private string $token,
    ) {
    }

    public function setToken(string $token): void
=======
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return void
     */
    public function setToken(string $token)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->token = $token;
    }

    /**
     * Gets the token.
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Sets the parent token.
<<<<<<< HEAD
     */
    public function setParent(self $parent): void
=======
     *
     * @return void
     */
    public function setParent(self $parent)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->parent = $parent;
    }

    /**
     * Returns the parent profile.
     */
    public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * Returns the parent token.
     */
    public function getParentToken(): ?string
    {
        return $this->parent?->getToken();
    }

    /**
     * Returns the IP.
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

<<<<<<< HEAD
    public function setIp(?string $ip): void
=======
    /**
     * @return void
     */
    public function setIp(?string $ip)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->ip = $ip;
    }

    /**
     * Returns the request method.
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

<<<<<<< HEAD
    public function setMethod(string $method): void
=======
    /**
     * @return void
     */
    public function setMethod(string $method)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->method = $method;
    }

    /**
     * Returns the URL.
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

<<<<<<< HEAD
    public function setUrl(?string $url): void
=======
    /**
     * @return void
     */
    public function setUrl(?string $url)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->url = $url;
    }

    public function getTime(): int
    {
        return $this->time ?? 0;
    }

<<<<<<< HEAD
    public function setTime(int $time): void
=======
    /**
     * @return void
     */
    public function setTime(int $time)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->time = $time;
    }

<<<<<<< HEAD
    public function setStatusCode(int $statusCode): void
=======
    /**
     * @return void
     */
    public function setStatusCode(int $statusCode)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @internal
     */
    public function setVirtualType(?string $virtualType): void
    {
        $this->virtualType = $virtualType;
    }

    /**
     * @internal
     */
    public function getVirtualType(): ?string
    {
        return $this->virtualType;
    }

    /**
     * Finds children profilers.
     *
     * @return self[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Sets children profiler.
     *
     * @param Profile[] $children
<<<<<<< HEAD
     */
    public function setChildren(array $children): void
=======
     *
     * @return void
     */
    public function setChildren(array $children)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->children = [];
        foreach ($children as $child) {
            $this->addChild($child);
        }
    }

    /**
     * Adds the child token.
<<<<<<< HEAD
     */
    public function addChild(self $child): void
=======
     *
     * @return void
     */
    public function addChild(self $child)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->children[] = $child;
        $child->setParent($this);
    }

    public function getChildByToken(string $token): ?self
    {
        foreach ($this->children as $child) {
            if ($token === $child->getToken()) {
                return $child;
            }
        }

        return null;
    }

    /**
     * Gets a Collector by name.
     *
     * @throws \InvalidArgumentException if the collector does not exist
     */
    public function getCollector(string $name): DataCollectorInterface
    {
        if (!isset($this->collectors[$name])) {
            throw new \InvalidArgumentException(\sprintf('Collector "%s" does not exist.', $name));
        }

        return $this->collectors[$name];
    }

    /**
     * Gets the Collectors associated with this profile.
     *
     * @return DataCollectorInterface[]
     */
    public function getCollectors(): array
    {
        return $this->collectors;
    }

    /**
     * Sets the Collectors associated with this profile.
     *
     * @param DataCollectorInterface[] $collectors
<<<<<<< HEAD
     */
    public function setCollectors(array $collectors): void
=======
     *
     * @return void
     */
    public function setCollectors(array $collectors)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->collectors = [];
        foreach ($collectors as $collector) {
            $this->addCollector($collector);
        }
    }

    /**
     * Adds a Collector.
<<<<<<< HEAD
     */
    public function addCollector(DataCollectorInterface $collector): void
=======
     *
     * @return void
     */
    public function addCollector(DataCollectorInterface $collector)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->collectors[$collector->getName()] = $collector;
    }

    public function hasCollector(string $name): bool
    {
        return isset($this->collectors[$name]);
    }

    public function __sleep(): array
    {
        return ['token', 'parent', 'children', 'collectors', 'ip', 'method', 'url', 'time', 'statusCode', 'virtualType'];
    }
}
