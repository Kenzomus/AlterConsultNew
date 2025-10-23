<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime;

use Symfony\Component\Mime\Exception\InvalidArgumentException;
use Symfony\Component\Mime\Exception\LogicException;
<<<<<<< HEAD
use Symfony\Component\Mime\Exception\RuntimeException;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

/**
 * Guesses the MIME type using the PECL extension FileInfo.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class FileinfoMimeTypeGuesser implements MimeTypeGuesserInterface
{
<<<<<<< HEAD
    /**
     * @var array<string, \finfo>
     */
    private static $finfoCache = [];
=======
    private ?string $magicFile;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * @param string|null $magicFile A magic file to use with the finfo instance
     *
     * @see https://php.net/finfo-open
     */
<<<<<<< HEAD
    public function __construct(
        private ?string $magicFile = null,
    ) {
=======
    public function __construct(?string $magicFile = null)
    {
        $this->magicFile = $magicFile;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function isGuesserSupported(): bool
    {
        return \function_exists('finfo_open');
    }

    public function guessMimeType(string $path): ?string
    {
        if (!is_file($path) || !is_readable($path)) {
            throw new InvalidArgumentException(\sprintf('The "%s" file does not exist or is not readable.', $path));
        }

        if (!$this->isGuesserSupported()) {
            throw new LogicException(\sprintf('The "%s" guesser is not supported.', __CLASS__));
        }

<<<<<<< HEAD
        try {
            $finfo = self::$finfoCache[$this->magicFile] ??= new \finfo(\FILEINFO_MIME_TYPE, $this->magicFile);
        } catch (\Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
        $mimeType = $finfo->file($path) ?: null;
=======
        if (false === $finfo = new \finfo(\FILEINFO_MIME_TYPE, $this->magicFile)) {
            return null;
        }
        $mimeType = $finfo->file($path);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        if ($mimeType && 0 === (\strlen($mimeType) % 2)) {
            $mimeStart = substr($mimeType, 0, \strlen($mimeType) >> 1);
            $mimeType = $mimeStart.$mimeStart === $mimeType ? $mimeStart : $mimeType;
        }

        return $mimeType;
    }
}
