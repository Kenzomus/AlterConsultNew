<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Attribute;

use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;

/**
<<<<<<< HEAD
=======
 * Annotation class for @SerializedPath().
 *
 * @Annotation
 * @NamedArgumentConstructor
 * @Target({"PROPERTY", "METHOD"})
 *
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Tobias Bönner <tobi@boenner.family>
 */
#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_PROPERTY)]
class SerializedPath
{
    private PropertyPath $serializedPath;

<<<<<<< HEAD
    /**
     * @param string $serializedPath A path using a valid PropertyAccess syntax where the value is stored in a normalized representation
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(string $serializedPath)
    {
        try {
            $this->serializedPath = new PropertyPath($serializedPath);
        } catch (InvalidPropertyPathException $pathException) {
            throw new InvalidArgumentException(\sprintf('Parameter given to "%s" must be a valid property path.', self::class));
        }
    }

    public function getSerializedPath(): PropertyPath
    {
        return $this->serializedPath;
    }
}

if (!class_exists(\Symfony\Component\Serializer\Annotation\SerializedPath::class, false)) {
    class_alias(SerializedPath::class, \Symfony\Component\Serializer\Annotation\SerializedPath::class);
}
