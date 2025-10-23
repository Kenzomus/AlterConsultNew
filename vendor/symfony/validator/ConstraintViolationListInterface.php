<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator;

use Symfony\Component\Validator\Exception\OutOfBoundsException;

/**
 * A list of constraint violations.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 *
 * @extends \ArrayAccess<int, ConstraintViolationInterface>
 * @extends \Traversable<int, ConstraintViolationInterface>
<<<<<<< HEAD
=======
 *
 * @method string __toString() Converts the violation into a string for debugging purposes. Not implementing it is deprecated since Symfony 6.1.
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 */
interface ConstraintViolationListInterface extends \Traversable, \Countable, \ArrayAccess
{
    /**
     * Adds a constraint violation to this list.
<<<<<<< HEAD
     */
    public function add(ConstraintViolationInterface $violation): void;

    /**
     * Merges an existing violation list into this list.
     */
    public function addAll(self $otherList): void;
=======
     *
     * @return void
     */
    public function add(ConstraintViolationInterface $violation);

    /**
     * Merges an existing violation list into this list.
     *
     * @return void
     */
    public function addAll(self $otherList);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Returns the violation at a given offset.
     *
     * @param int $offset The offset of the violation
     *
     * @throws OutOfBoundsException if the offset does not exist
     */
    public function get(int $offset): ConstraintViolationInterface;

    /**
     * Returns whether the given offset exists.
     *
     * @param int $offset The violation offset
     */
    public function has(int $offset): bool;

    /**
     * Sets a violation at a given offset.
     *
     * @param int $offset The violation offset
<<<<<<< HEAD
     */
    public function set(int $offset, ConstraintViolationInterface $violation): void;
=======
     *
     * @return void
     */
    public function set(int $offset, ConstraintViolationInterface $violation);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Removes a violation at a given offset.
     *
     * @param int $offset The offset to remove
<<<<<<< HEAD
     */
    public function remove(int $offset): void;

    /**
     * Converts the violation into a string for debugging purposes.
     */
    public function __toString(): string;
=======
     *
     * @return void
     */
    public function remove(int $offset);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
