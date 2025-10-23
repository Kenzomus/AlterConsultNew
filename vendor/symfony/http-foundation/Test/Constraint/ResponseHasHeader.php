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

final class ResponseHasHeader extends Constraint
{
<<<<<<< HEAD
    public function __construct(
        private string $headerName,
    ) {
=======
    private string $headerName;

    public function __construct(string $headerName)
    {
        $this->headerName = $headerName;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function toString(): string
    {
        return \sprintf('has header "%s"', $this->headerName);
    }

    /**
     * @param Response $response
     */
    protected function matches($response): bool
    {
        return $response->headers->has($this->headerName);
    }

    /**
     * @param Response $response
     */
    protected function failureDescription($response): string
    {
        return 'the Response '.$this->toString();
    }
}
