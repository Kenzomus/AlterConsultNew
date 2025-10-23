<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session;

use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;

/**
 * Interface for the session.
 *
 * @author Drak <drak@zikula.org>
 */
interface SessionInterface
{
    /**
     * Starts the session storage.
     *
     * @throws \RuntimeException if session fails to start
     */
    public function start(): bool;

    /**
     * Returns the session ID.
     */
    public function getId(): string;

    /**
     * Sets the session ID.
<<<<<<< HEAD
     */
    public function setId(string $id): void;
=======
     *
     * @return void
     */
    public function setId(string $id);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Returns the session name.
     */
    public function getName(): string;

    /**
     * Sets the session name.
<<<<<<< HEAD
     */
    public function setName(string $name): void;
=======
     *
     * @return void
     */
    public function setName(string $name);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Invalidates the current session.
     *
     * Clears all session attributes and flashes and regenerates the
     * session and deletes the old session from persistence.
     *
     * @param int|null $lifetime Sets the cookie lifetime for the session cookie. A null value
     *                           will leave the system settings unchanged, 0 sets the cookie
     *                           to expire with browser session. Time is in seconds, and is
     *                           not a Unix timestamp.
     */
    public function invalidate(?int $lifetime = null): bool;

    /**
     * Migrates the current session to a new session id while maintaining all
     * session attributes.
     *
     * @param bool     $destroy  Whether to delete the old session or leave it to garbage collection
     * @param int|null $lifetime Sets the cookie lifetime for the session cookie. A null value
     *                           will leave the system settings unchanged, 0 sets the cookie
     *                           to expire with browser session. Time is in seconds, and is
     *                           not a Unix timestamp.
     */
    public function migrate(bool $destroy = false, ?int $lifetime = null): bool;

    /**
     * Force the session to be saved and closed.
     *
     * This method is generally not required for real sessions as
     * the session will be automatically saved at the end of
     * code execution.
<<<<<<< HEAD
     */
    public function save(): void;
=======
     *
     * @return void
     */
    public function save();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Checks if an attribute is defined.
     */
    public function has(string $name): bool;

    /**
     * Returns an attribute.
     */
    public function get(string $name, mixed $default = null): mixed;

    /**
     * Sets an attribute.
<<<<<<< HEAD
     */
    public function set(string $name, mixed $value): void;
=======
     *
     * @return void
     */
    public function set(string $name, mixed $value);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Returns attributes.
     */
    public function all(): array;

    /**
     * Sets attributes.
<<<<<<< HEAD
     */
    public function replace(array $attributes): void;
=======
     *
     * @return void
     */
    public function replace(array $attributes);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Removes an attribute.
     *
     * @return mixed The removed value or null when it does not exist
     */
    public function remove(string $name): mixed;

    /**
     * Clears all attributes.
<<<<<<< HEAD
     */
    public function clear(): void;
=======
     *
     * @return void
     */
    public function clear();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Checks if the session was started.
     */
    public function isStarted(): bool;

    /**
     * Registers a SessionBagInterface with the session.
<<<<<<< HEAD
     */
    public function registerBag(SessionBagInterface $bag): void;
=======
     *
     * @return void
     */
    public function registerBag(SessionBagInterface $bag);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Gets a bag instance by name.
     */
    public function getBag(string $name): SessionBagInterface;

    /**
     * Gets session meta.
     */
    public function getMetadataBag(): MetadataBag;
}
