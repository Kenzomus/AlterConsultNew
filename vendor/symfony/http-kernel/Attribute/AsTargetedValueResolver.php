<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Attribute;

/**
 * Service tag to autoconfigure targeted value resolvers.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class AsTargetedValueResolver
{
<<<<<<< HEAD
    /**
     * @param string|null $name The name with which the resolver can be targeted
     */
    public function __construct(public readonly ?string $name = null)
    {
=======
    public function __construct(
        public readonly ?string $name = null,
    ) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
