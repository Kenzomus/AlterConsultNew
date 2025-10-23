<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing;

interface RequestContextAwareInterface
{
    /**
     * Sets the request context.
<<<<<<< HEAD
     */
    public function setContext(RequestContext $context): void;
=======
     *
     * @return void
     */
    public function setContext(RequestContext $context);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Gets the request context.
     */
    public function getContext(): RequestContext;
}
