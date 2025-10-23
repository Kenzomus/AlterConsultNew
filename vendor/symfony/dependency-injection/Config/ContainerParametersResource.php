<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Config;

use Symfony\Component\Config\Resource\ResourceInterface;

/**
 * Tracks container parameters.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 *
 * @final
 */
class ContainerParametersResource implements ResourceInterface
{
<<<<<<< HEAD
    /**
     * @param array $parameters The container parameters to track
     */
    public function __construct(
        private array $parameters,
    ) {
=======
    private array $parameters;

    /**
     * @param array $parameters The container parameters to track
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function __toString(): string
    {
        return 'container_parameters_'.hash('xxh128', serialize($this->parameters));
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
