<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Encoder;

use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
interface DecoderInterface
{
    /**
     * Decodes a string into PHP data.
     *
     * @param string $data    Data to decode
     * @param string $format  Format name
     * @param array  $context Options that decoders have access to
     *
     * The format parameter specifies which format the data is in; valid values
     * depend on the specific implementation. Authors implementing this interface
     * are encouraged to document which formats they support in a non-inherited
     * phpdoc comment.
     *
<<<<<<< HEAD
     * @throws UnexpectedValueException
     */
    public function decode(string $data, string $format, array $context = []): mixed;
=======
     * @return mixed
     *
     * @throws UnexpectedValueException
     */
    public function decode(string $data, string $format, array $context = []);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Checks whether the deserializer can decode from given format.
     *
     * @param string $format Format name
<<<<<<< HEAD
     */
    public function supportsDecoding(string $format): bool;
=======
     *
     * @return bool
     */
    public function supportsDecoding(string $format);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
