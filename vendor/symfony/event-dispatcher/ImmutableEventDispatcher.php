<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * A read-only proxy for an event dispatcher.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ImmutableEventDispatcher implements EventDispatcherInterface
{
<<<<<<< HEAD
    public function __construct(
        private EventDispatcherInterface $dispatcher,
    ) {
=======
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function dispatch(object $event, ?string $eventName = null): object
    {
        return $this->dispatcher->dispatch($event, $eventName);
    }

<<<<<<< HEAD
    public function addListener(string $eventName, callable|array $listener, int $priority = 0): never
=======
    /**
     * @return never
     */
    public function addListener(string $eventName, callable|array $listener, int $priority = 0)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

<<<<<<< HEAD
    public function addSubscriber(EventSubscriberInterface $subscriber): never
=======
    /**
     * @return never
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

<<<<<<< HEAD
    public function removeListener(string $eventName, callable|array $listener): never
=======
    /**
     * @return never
     */
    public function removeListener(string $eventName, callable|array $listener)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

<<<<<<< HEAD
    public function removeSubscriber(EventSubscriberInterface $subscriber): never
=======
    /**
     * @return never
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    public function getListeners(?string $eventName = null): array
    {
        return $this->dispatcher->getListeners($eventName);
    }

    public function getListenerPriority(string $eventName, callable|array $listener): ?int
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    public function hasListeners(?string $eventName = null): bool
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}
