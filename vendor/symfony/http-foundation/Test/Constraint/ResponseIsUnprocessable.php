<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\HttpFoundation\Response;

final class ResponseIsUnprocessable extends Constraint
{
<<<<<<< HEAD
    /**
     * @param bool $verbose If true, the entire response is printed on failure. If false, the response body is omitted.
     */
    public function __construct(private readonly bool $verbose = true)
    {
    }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function toString(): string
    {
        return 'is unprocessable';
    }

    /**
     * @param Response $other
     */
    protected function matches($other): bool
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY === $other->getStatusCode();
    }

    /**
     * @param Response $other
     */
    protected function failureDescription($other): string
    {
        return 'the Response '.$this->toString();
    }

    /**
<<<<<<< HEAD
     * @param Response $response
     */
    protected function additionalFailureDescription($response): string
    {
        return $this->verbose ? (string) $response : explode("\r\n\r\n", (string) $response)[0];
=======
     * @param Response $other
     */
    protected function additionalFailureDescription($other): string
    {
        return (string) $other;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
