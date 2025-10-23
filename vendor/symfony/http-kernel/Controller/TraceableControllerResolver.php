<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableControllerResolver implements ControllerResolverInterface
{
<<<<<<< HEAD
    public function __construct(
        private ControllerResolverInterface $resolver,
        private Stopwatch $stopwatch,
    ) {
=======
    private ControllerResolverInterface $resolver;
    private Stopwatch $stopwatch;

    public function __construct(ControllerResolverInterface $resolver, Stopwatch $stopwatch)
    {
        $this->resolver = $resolver;
        $this->stopwatch = $stopwatch;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getController(Request $request): callable|false
    {
        $e = $this->stopwatch->start('controller.get_callable');

        try {
            return $this->resolver->getController($request);
        } finally {
            $e->stop();
        }
    }
}
