<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Attribute;

/**
 * An attribute to tell how a base type should be tagged.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class AutoconfigureTag extends Autoconfigure
{
<<<<<<< HEAD
    /**
     * @param string|null             $name       The tag name to add
     * @param array<array-key, mixed> $attributes The tag attributes to attach to the tag
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(?string $name = null, array $attributes = [])
    {
        parent::__construct(
            tags: [
                [$name ?? 0 => $attributes],
            ]
        );
    }
}
