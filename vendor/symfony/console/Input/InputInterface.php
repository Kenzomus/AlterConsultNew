<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * InputInterface is the interface implemented by all input classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
<<<<<<< HEAD
=======
 *
 * @method string __toString() Returns a stringified representation of the args passed to the command.
 *                             InputArguments MUST be escaped as well as the InputOption values passed to the command.
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 */
interface InputInterface
{
    /**
     * Returns the first argument from the raw parameters (not parsed).
     */
    public function getFirstArgument(): ?string;

    /**
     * Returns true if the raw parameters (not parsed) contain a value.
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values     The values to look for in the raw parameters (can be an array)
     * @param bool         $onlyParams Only check real parameters, skip those following an end of options (--) signal
     */
    public function hasParameterOption(string|array $values, bool $onlyParams = false): bool;

    /**
     * Returns the value of a raw option (not parsed).
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array                     $values     The value(s) to look for in the raw parameters (can be an array)
     * @param string|bool|int|float|array|null $default    The default value to return if no result is found
     * @param bool                             $onlyParams Only check real parameters, skip those following an end of options (--) signal
<<<<<<< HEAD
     */
    public function getParameterOption(string|array $values, string|bool|int|float|array|null $default = false, bool $onlyParams = false): mixed;
=======
     *
     * @return mixed
     */
    public function getParameterOption(string|array $values, string|bool|int|float|array|null $default = false, bool $onlyParams = false);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Binds the current Input instance with the given arguments and options.
     *
<<<<<<< HEAD
     * @throws RuntimeException
     */
    public function bind(InputDefinition $definition): void;
=======
     * @return void
     *
     * @throws RuntimeException
     */
    public function bind(InputDefinition $definition);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Validates the input.
     *
<<<<<<< HEAD
     * @throws RuntimeException When not enough arguments are given
     */
    public function validate(): void;
=======
     * @return void
     *
     * @throws RuntimeException When not enough arguments are given
     */
    public function validate();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Returns all the given arguments merged with the default values.
     *
     * @return array<string|bool|int|float|array|null>
     */
    public function getArguments(): array;

    /**
     * Returns the argument value for a given argument name.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function getArgument(string $name): mixed;
=======
     * @return mixed
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function getArgument(string $name);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Sets an argument value by name.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function setArgument(string $name, mixed $value): void;
=======
     * @return void
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function setArgument(string $name, mixed $value);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Returns true if an InputArgument object exists by name or position.
     */
    public function hasArgument(string $name): bool;

    /**
     * Returns all the given options merged with the default values.
     *
     * @return array<string|bool|int|float|array|null>
     */
    public function getOptions(): array;

    /**
     * Returns the option value for a given option name.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function getOption(string $name): mixed;
=======
     * @return mixed
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function getOption(string $name);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Sets an option value by name.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function setOption(string $name, mixed $value): void;
=======
     * @return void
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function setOption(string $name, mixed $value);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Returns true if an InputOption object exists by name.
     */
    public function hasOption(string $name): bool;

    /**
     * Is this input means interactive?
     */
    public function isInteractive(): bool;

    /**
     * Sets the input interactivity.
<<<<<<< HEAD
     */
    public function setInteractive(bool $interactive): void;

    /**
     * Returns a stringified representation of the args passed to the command.
     *
     * InputArguments MUST be escaped as well as the InputOption values passed to the command.
     */
    public function __toString(): string;
=======
     *
     * @return void
     */
    public function setInteractive(bool $interactive);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
