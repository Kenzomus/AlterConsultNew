<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Mapping\Factory;

use Symfony\Component\Validator\Exception\NoSuchMetadataException;
use Symfony\Component\Validator\Mapping\MetadataInterface;

/**
<<<<<<< HEAD
 * Returns {@link MetadataInterface} instances for values.
=======
 * Returns {@link \Symfony\Component\Validator\Mapping\MetadataInterface} instances for values.
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface MetadataFactoryInterface
{
    /**
     * Returns the metadata for the given value.
     *
     * @throws NoSuchMetadataException If no metadata exists for the given value
     */
    public function getMetadataFor(mixed $value): MetadataInterface;

    /**
     * Returns whether the class is able to return metadata for the given value.
     */
    public function hasMetadataFor(mixed $value): bool;
}
