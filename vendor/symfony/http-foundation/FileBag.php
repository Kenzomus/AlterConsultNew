<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * FileBag is a container for uploaded files.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bulat Shakirzyanov <mallluhuct@gmail.com>
 */
class FileBag extends ParameterBag
{
<<<<<<< HEAD
    private const FILE_KEYS = ['error', 'full_path', 'name', 'size', 'tmp_name', 'type'];
=======
    private const FILE_KEYS = ['error', 'name', 'size', 'tmp_name', 'type'];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * @param array|UploadedFile[] $parameters An array of HTTP files
     */
    public function __construct(array $parameters = [])
    {
        $this->replace($parameters);
    }

<<<<<<< HEAD
    public function replace(array $files = []): void
=======
    /**
     * @return void
     */
    public function replace(array $files = [])
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->parameters = [];
        $this->add($files);
    }

<<<<<<< HEAD
    public function set(string $key, mixed $value): void
=======
    /**
     * @return void
     */
    public function set(string $key, mixed $value)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (!\is_array($value) && !$value instanceof UploadedFile) {
            throw new \InvalidArgumentException('An uploaded file must be an array or an instance of UploadedFile.');
        }

        parent::set($key, $this->convertFileInformation($value));
    }

<<<<<<< HEAD
    public function add(array $files = []): void
=======
    /**
     * @return void
     */
    public function add(array $files = [])
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach ($files as $key => $file) {
            $this->set($key, $file);
        }
    }

    /**
     * Converts uploaded files to UploadedFile instances.
     *
     * @return UploadedFile[]|UploadedFile|null
     */
    protected function convertFileInformation(array|UploadedFile $file): array|UploadedFile|null
    {
        if ($file instanceof UploadedFile) {
            return $file;
        }

        $file = $this->fixPhpFilesArray($file);
<<<<<<< HEAD
        $keys = array_keys($file + ['full_path' => null]);
        sort($keys);

        if (self::FILE_KEYS === $keys) {
            if (\UPLOAD_ERR_NO_FILE === $file['error']) {
                $file = null;
            } else {
                $file = new UploadedFile($file['tmp_name'], $file['full_path'] ?? $file['name'], $file['type'], $file['error'], false);
            }
        } else {
            $file = array_map(fn ($v) => $v instanceof UploadedFile || \is_array($v) ? $this->convertFileInformation($v) : $v, $file);
            if (array_is_list($file)) {
=======
        $keys = array_keys($file);
        sort($keys);

        if (self::FILE_KEYS == $keys) {
            if (\UPLOAD_ERR_NO_FILE == $file['error']) {
                $file = null;
            } else {
                $file = new UploadedFile($file['tmp_name'], $file['name'], $file['type'], $file['error'], false);
            }
        } else {
            $file = array_map(fn ($v) => $v instanceof UploadedFile || \is_array($v) ? $this->convertFileInformation($v) : $v, $file);
            if (array_keys($keys) === $keys) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                $file = array_filter($file);
            }
        }

        return $file;
    }

    /**
     * Fixes a malformed PHP $_FILES array.
     *
     * PHP has a bug that the format of the $_FILES array differs, depending on
     * whether the uploaded file fields had normal field names or array-like
     * field names ("normal" vs. "parent[child]").
     *
     * This method fixes the array to look like the "normal" $_FILES array.
     *
     * It's safe to pass an already converted array, in which case this method
     * just returns the original array unmodified.
     */
    protected function fixPhpFilesArray(array $data): array
    {
<<<<<<< HEAD
        $keys = array_keys($data + ['full_path' => null]);
        sort($keys);

        if (self::FILE_KEYS !== $keys || !isset($data['name']) || !\is_array($data['name'])) {
=======
        // Remove extra key added by PHP 8.1.
        unset($data['full_path']);
        $keys = array_keys($data);
        sort($keys);

        if (self::FILE_KEYS != $keys || !isset($data['name']) || !\is_array($data['name'])) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            return $data;
        }

        $files = $data;
        foreach (self::FILE_KEYS as $k) {
            unset($files[$k]);
        }

        foreach ($data['name'] as $key => $name) {
            $files[$key] = $this->fixPhpFilesArray([
                'error' => $data['error'][$key],
                'name' => $name,
                'type' => $data['type'][$key],
                'tmp_name' => $data['tmp_name'][$key],
                'size' => $data['size'][$key],
<<<<<<< HEAD
            ] + (isset($data['full_path'][$key]) ? [
                'full_path' => $data['full_path'][$key],
            ] : []));
=======
            ]);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $files;
    }
}
