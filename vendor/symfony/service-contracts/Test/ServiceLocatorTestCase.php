<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Contracts\Service\Test;

use PHPUnit\Framework\TestCase;
<<<<<<< HEAD
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
=======
use Psr\Container\ContainerInterface;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Contracts\Service\ServiceLocatorTrait;

abstract class ServiceLocatorTestCase extends TestCase
{
<<<<<<< HEAD
    /**
     * @param array<string, callable> $factories
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function getServiceLocator(array $factories): ContainerInterface
    {
        return new class($factories) implements ContainerInterface {
            use ServiceLocatorTrait;
        };
    }

    public function testHas()
    {
        $locator = $this->getServiceLocator([
            'foo' => fn () => 'bar',
            'bar' => fn () => 'baz',
            fn () => 'dummy',
        ]);

        $this->assertTrue($locator->has('foo'));
        $this->assertTrue($locator->has('bar'));
        $this->assertFalse($locator->has('dummy'));
    }

    public function testGet()
    {
        $locator = $this->getServiceLocator([
            'foo' => fn () => 'bar',
            'bar' => fn () => 'baz',
        ]);

        $this->assertSame('bar', $locator->get('foo'));
        $this->assertSame('baz', $locator->get('bar'));
    }

    public function testGetDoesNotMemoize()
    {
        $i = 0;
        $locator = $this->getServiceLocator([
            'foo' => function () use (&$i) {
                ++$i;

                return 'bar';
            },
        ]);

        $this->assertSame('bar', $locator->get('foo'));
        $this->assertSame('bar', $locator->get('foo'));
        $this->assertSame(2, $i);
    }

    public function testThrowsOnUndefinedInternalService()
    {
<<<<<<< HEAD
=======
        if (!$this->getExpectedException()) {
            $this->expectException(\Psr\Container\NotFoundExceptionInterface::class);
            $this->expectExceptionMessage('The service "foo" has a dependency on a non-existent service "bar". This locator only knows about the "foo" service.');
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $locator = $this->getServiceLocator([
            'foo' => function () use (&$locator) { return $locator->get('bar'); },
        ]);

<<<<<<< HEAD
        $this->expectException(NotFoundExceptionInterface::class);
        $this->expectExceptionMessage('The service "foo" has a dependency on a non-existent service "bar". This locator only knows about the "foo" service.');

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $locator->get('foo');
    }

    public function testThrowsOnCircularReference()
    {
<<<<<<< HEAD
=======
        $this->expectException(\Psr\Container\ContainerExceptionInterface::class);
        $this->expectExceptionMessage('Circular reference detected for service "bar", path: "bar -> baz -> bar".');
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $locator = $this->getServiceLocator([
            'foo' => function () use (&$locator) { return $locator->get('bar'); },
            'bar' => function () use (&$locator) { return $locator->get('baz'); },
            'baz' => function () use (&$locator) { return $locator->get('bar'); },
        ]);

<<<<<<< HEAD
        $this->expectException(ContainerExceptionInterface::class);
        $this->expectExceptionMessage('Circular reference detected for service "bar", path: "bar -> baz -> bar".');

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $locator->get('foo');
    }
}
