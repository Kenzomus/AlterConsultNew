<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Exception;

/**
 * This exception is thrown when a circular reference is detected.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class ServiceCircularReferenceException extends RuntimeException
{
<<<<<<< HEAD
    public function __construct(
        private string $serviceId,
        private array $path,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(\sprintf('Circular reference detected for service "%s", path: "%s".', $serviceId, implode(' -> ', $path)), 0, $previous);
    }

    public function getServiceId(): string
=======
    private string $serviceId;
    private array $path;

    public function __construct(string $serviceId, array $path, ?\Throwable $previous = null)
    {
        parent::__construct(\sprintf('Circular reference detected for service "%s", path: "%s".', $serviceId, implode(' -> ', $path)), 0, $previous);

        $this->serviceId = $serviceId;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getServiceId()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->serviceId;
    }

<<<<<<< HEAD
    public function getPath(): array
=======
    /**
     * @return array
     */
    public function getPath()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->path;
    }
}
