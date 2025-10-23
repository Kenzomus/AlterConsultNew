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
trait DenormalizerAwareTrait
{
<<<<<<< HEAD
    protected DenormalizerInterface $denormalizer;

    public function setDenormalizer(DenormalizerInterface $denormalizer): void
=======
    /**
     * @var DenormalizerInterface
     */
    protected $denormalizer;

    /**
     * @return void
     */
    public function setDenormalizer(DenormalizerInterface $denormalizer)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->denormalizer = $denormalizer;
    }
}
