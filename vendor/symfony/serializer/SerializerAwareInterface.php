<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer;

/**
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
interface SerializerAwareInterface
{
    /**
     * Sets the owning Serializer object.
<<<<<<< HEAD
     */
    public function setSerializer(SerializerInterface $serializer): void;
=======
     *
     * @return void
     */
    public function setSerializer(SerializerInterface $serializer);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
