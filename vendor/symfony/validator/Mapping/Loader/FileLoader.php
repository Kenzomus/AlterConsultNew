<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Mapping\Loader;

use Symfony\Component\Validator\Exception\MappingException;

/**
 * Base loader for loading validation metadata from a file.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 *
 * @see YamlFileLoader
 * @see XmlFileLoader
 */
abstract class FileLoader extends AbstractLoader
{
<<<<<<< HEAD
=======
    protected $file;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * Creates a new loader.
     *
     * @param string $file The mapping file to load
     *
     * @throws MappingException If the file does not exist or is not readable
     */
<<<<<<< HEAD
    public function __construct(
        protected string $file,
    ) {
=======
    public function __construct(string $file)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if (!is_file($file)) {
            throw new MappingException(\sprintf('The mapping file "%s" does not exist.', $file));
        }

        if (!is_readable($file)) {
            throw new MappingException(\sprintf('The mapping file "%s" is not readable.', $file));
        }

        if (!stream_is_local($this->file)) {
            throw new MappingException(\sprintf('The mapping file "%s" is not a local file.', $file));
        }
<<<<<<< HEAD
=======

        $this->file = $file;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
