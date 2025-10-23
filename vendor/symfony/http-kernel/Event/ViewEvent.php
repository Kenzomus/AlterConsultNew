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

/**
 * Allows to create a response for the return value of a controller.
 *
 * Call setResponse() to set the response that will be returned for the
 * current request. The propagation of this event is stopped as soon as a
 * response is set.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
final class ViewEvent extends RequestEvent
{
<<<<<<< HEAD
    public function __construct(
        HttpKernelInterface $kernel,
        Request $request,
        int $requestType,
        private mixed $controllerResult,
        public readonly ?ControllerArgumentsEvent $controllerArgumentsEvent = null,
    ) {
        parent::__construct($kernel, $request, $requestType);
=======
    public readonly ?ControllerArgumentsEvent $controllerArgumentsEvent;
    private mixed $controllerResult;

    public function __construct(HttpKernelInterface $kernel, Request $request, int $requestType, mixed $controllerResult, ?ControllerArgumentsEvent $controllerArgumentsEvent = null)
    {
        parent::__construct($kernel, $request, $requestType);

        $this->controllerResult = $controllerResult;
        $this->controllerArgumentsEvent = $controllerArgumentsEvent;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getControllerResult(): mixed
    {
        return $this->controllerResult;
    }

    public function setControllerResult(mixed $controllerResult): void
    {
        $this->controllerResult = $controllerResult;
    }
}
