<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime\Part;

use Symfony\Component\Mime\Message;
use Symfony\Component\Mime\RawMessage;

/**
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class MessagePart extends DataPart
{
<<<<<<< HEAD
    public function __construct(
        private RawMessage $message,
    ) {
=======
    private RawMessage $message;

    public function __construct(RawMessage $message)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if ($message instanceof Message) {
            $name = $message->getHeaders()->getHeaderBody('Subject').'.eml';
        } else {
            $name = 'email.eml';
        }
        parent::__construct('', $name);
<<<<<<< HEAD
=======

        $this->message = $message;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getMediaType(): string
    {
        return 'message';
    }

    public function getMediaSubtype(): string
    {
        return 'rfc822';
    }

    public function getBody(): string
    {
        return $this->message->toString();
    }

    public function bodyToString(): string
    {
        return $this->getBody();
    }

    public function bodyToIterable(): iterable
    {
        return $this->message->toIterable();
    }

    public function __sleep(): array
    {
        return ['message'];
    }

    public function __wakeup(): void
    {
        $this->__construct($this->message);
    }
}
