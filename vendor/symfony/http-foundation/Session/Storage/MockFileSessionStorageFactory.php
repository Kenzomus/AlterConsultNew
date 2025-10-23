<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Storage;

use Symfony\Component\HttpFoundation\Request;

// Help opcache.preload discover always-needed symbols
class_exists(MockFileSessionStorage::class);

/**
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class MockFileSessionStorageFactory implements SessionStorageFactoryInterface
{
<<<<<<< HEAD
    /**
     * @see MockFileSessionStorage constructor.
     */
    public function __construct(
        private ?string $savePath = null,
        private string $name = 'MOCKSESSID',
        private ?MetadataBag $metaBag = null,
    ) {
=======
    private ?string $savePath;
    private string $name;
    private ?MetadataBag $metaBag;

    /**
     * @see MockFileSessionStorage constructor.
     */
    public function __construct(?string $savePath = null, string $name = 'MOCKSESSID', ?MetadataBag $metaBag = null)
    {
        $this->savePath = $savePath;
        $this->name = $name;
        $this->metaBag = $metaBag;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function createStorage(?Request $request): SessionStorageInterface
    {
        return new MockFileSessionStorage($this->savePath, $this->name, $this->metaBag);
    }
}
