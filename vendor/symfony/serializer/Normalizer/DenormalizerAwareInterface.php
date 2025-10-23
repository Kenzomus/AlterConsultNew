<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Normalizer;

/**
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
interface DenormalizerAwareInterface
{
    /**
     * Sets the owning Denormalizer object.
<<<<<<< HEAD
     */
    public function setDenormalizer(DenormalizerInterface $denormalizer): void;
=======
     *
     * @return void
     */
    public function setDenormalizer(DenormalizerInterface $denormalizer);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
