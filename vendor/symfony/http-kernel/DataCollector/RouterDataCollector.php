<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class RouterDataCollector extends DataCollector
{
    /**
     * @var \SplObjectStorage<Request, callable>
     */
<<<<<<< HEAD
    protected \SplObjectStorage $controllers;
=======
    protected $controllers;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct()
    {
        $this->reset();
    }

    /**
     * @final
     */
    public function collect(Request $request, Response $response, ?\Throwable $exception = null): void
    {
        if ($response instanceof RedirectResponse) {
            $this->data['redirect'] = true;
            $this->data['url'] = $response->getTargetUrl();

            if ($this->controllers->offsetExists($request)) {
                $this->data['route'] = $this->guessRoute($request, $this->controllers[$request]);
            }
        }

        unset($this->controllers[$request]);
    }

<<<<<<< HEAD
    public function reset(): void
=======
    /**
     * @return void
     */
    public function reset()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->controllers = new \SplObjectStorage();

        $this->data = [
            'redirect' => false,
            'url' => null,
            'route' => null,
        ];
    }

<<<<<<< HEAD
    protected function guessRoute(Request $request, string|object|array $controller): string
=======
    /**
     * @return string
     */
    protected function guessRoute(Request $request, string|object|array $controller)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return 'n/a';
    }

    /**
     * Remembers the controller associated to each request.
<<<<<<< HEAD
     */
    public function onKernelController(ControllerEvent $event): void
=======
     *
     * @return void
     */
    public function onKernelController(ControllerEvent $event)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->controllers[$event->getRequest()] = $event->getController();
    }

    /**
     * @return bool Whether this request will result in a redirect
     */
    public function getRedirect(): bool
    {
        return $this->data['redirect'];
    }

    public function getTargetUrl(): ?string
    {
        return $this->data['url'];
    }

    public function getTargetRoute(): ?string
    {
        return $this->data['route'];
    }

    public function getName(): string
    {
        return 'router';
    }
}
