<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Base class for events dispatched in the HttpKernel component.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class KernelEvent extends Event
{
<<<<<<< HEAD
=======
    private HttpKernelInterface $kernel;
    private Request $request;
    private ?int $requestType;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * @param int $requestType The request type the kernel is currently processing; one of
     *                         HttpKernelInterface::MAIN_REQUEST or HttpKernelInterface::SUB_REQUEST
     */
<<<<<<< HEAD
    public function __construct(
        private HttpKernelInterface $kernel,
        private Request $request,
        private ?int $requestType,
    ) {
=======
    public function __construct(HttpKernelInterface $kernel, Request $request, ?int $requestType)
    {
        $this->kernel = $kernel;
        $this->request = $request;
        $this->requestType = $requestType;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * Returns the kernel in which this event was thrown.
     */
    public function getKernel(): HttpKernelInterface
    {
        return $this->kernel;
    }

    /**
     * Returns the request the kernel is currently processing.
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Returns the request type the kernel is currently processing.
     *
     * @return int One of HttpKernelInterface::MAIN_REQUEST and
     *             HttpKernelInterface::SUB_REQUEST
     */
    public function getRequestType(): int
    {
        return $this->requestType;
    }

    /**
     * Checks if this is the main request.
     */
    public function isMainRequest(): bool
    {
        return HttpKernelInterface::MAIN_REQUEST === $this->requestType;
    }
}
