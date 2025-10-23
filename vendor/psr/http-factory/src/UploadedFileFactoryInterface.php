<?php

namespace Psr\Http\Message;

interface UploadedFileFactoryInterface
{
    /**
     * Create a new uploaded file.
     *
     * If a size is not provided it will be determined by checking the size of
     * the file.
     *
     * @see http://php.net/manual/features.file-upload.post-method.php
     * @see http://php.net/manual/features.file-upload.errors.php
     *
     * @param StreamInterface $stream Underlying stream representing the
     *     uploaded file content.
<<<<<<< HEAD
     * @param int|null $size in bytes
     * @param int $error PHP file upload error
     * @param string|null $clientFilename Filename as provided by the client, if any.
     * @param string|null $clientMediaType Media type as provided by the client, if any.
=======
     * @param int $size in bytes
     * @param int $error PHP file upload error
     * @param string $clientFilename Filename as provided by the client, if any.
     * @param string $clientMediaType Media type as provided by the client, if any.
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     *
     * @return UploadedFileInterface
     *
     * @throws \InvalidArgumentException If the file resource is not readable.
     */
    public function createUploadedFile(
        StreamInterface $stream,
<<<<<<< HEAD
        ?int $size = null,
        int $error = \UPLOAD_ERR_OK,
        ?string $clientFilename = null,
        ?string $clientMediaType = null
=======
        int $size = null,
        int $error = \UPLOAD_ERR_OK,
        string $clientFilename = null,
        string $clientMediaType = null
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ): UploadedFileInterface;
}
