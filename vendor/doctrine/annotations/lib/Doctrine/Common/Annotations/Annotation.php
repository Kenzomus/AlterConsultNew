<?php

namespace Doctrine\Common\Annotations;

use BadMethodCallException;

use function sprintf;

/**
 * Annotations class.
 */
class Annotation
{
    /**
     * Value property. Common among all derived classes.
     *
     * @var mixed
     */
    public $value;

    /** @param array<string, mixed> $data Key-value for properties to be defined in this class. */
    final public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Error handler for unknown property accessor in Annotation class.
     *
<<<<<<< HEAD
     * @throws BadMethodCallException
     */
    public function __get(string $name)
=======
     * @param string $name Unknown property name.
     *
     * @throws BadMethodCallException
     */
    public function __get($name)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new BadMethodCallException(
            sprintf("Unknown property '%s' on annotation '%s'.", $name, static::class)
        );
    }

    /**
     * Error handler for unknown property mutator in Annotation class.
     *
<<<<<<< HEAD
     * @param mixed $value Property value.
     *
     * @throws BadMethodCallException
     */
    public function __set(string $name, $value)
=======
     * @param string $name  Unknown property name.
     * @param mixed  $value Property value.
     *
     * @throws BadMethodCallException
     */
    public function __set($name, $value)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        throw new BadMethodCallException(
            sprintf("Unknown property '%s' on annotation '%s'.", $name, static::class)
        );
    }
}
