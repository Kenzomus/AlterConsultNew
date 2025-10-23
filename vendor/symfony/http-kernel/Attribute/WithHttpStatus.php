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
<<<<<<< HEAD
 * Defines the HTTP status code applied to an exception.
 *
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Dejan Angelov <angelovdejan@protonmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class WithHttpStatus
{
    /**
<<<<<<< HEAD
     * @param int                   $statusCode The HTTP status code to use
     * @param array<string, string> $headers    The HTTP headers to add to the response
=======
     * @param array<string, string> $headers
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function __construct(
        public readonly int $statusCode,
        public readonly array $headers = [],
    ) {
    }
}
