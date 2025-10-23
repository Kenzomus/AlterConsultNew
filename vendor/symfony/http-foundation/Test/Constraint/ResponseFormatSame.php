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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Asserts that the response is in the given format.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
final class ResponseFormatSame extends Constraint
{
<<<<<<< HEAD
    public function __construct(
        private Request $request,
        private ?string $format,
        private readonly bool $verbose = true,
    ) {
=======
    private Request $request;
    private ?string $format;

    public function __construct(Request $request, ?string $format)
    {
        $this->request = $request;
        $this->format = $format;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function toString(): string
    {
        return 'format is '.($this->format ?? 'null');
    }

    /**
     * @param Response $response
     */
    protected function matches($response): bool
    {
        return $this->format === $this->request->getFormat($response->headers->get('Content-Type'));
    }

    /**
     * @param Response $response
     */
    protected function failureDescription($response): string
    {
        return 'the Response '.$this->toString();
    }

    /**
     * @param Response $response
     */
    protected function additionalFailureDescription($response): string
    {
<<<<<<< HEAD
        return $this->verbose ? (string) $response : explode("\r\n\r\n", (string) $response)[0];
=======
        return (string) $response;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
