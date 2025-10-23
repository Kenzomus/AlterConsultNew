<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mailer\Messenger;

use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mime\RawMessage;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class SendEmailMessage
{
<<<<<<< HEAD
    public function __construct(
        private RawMessage $message,
        private ?Envelope $envelope = null,
    ) {
=======
    private RawMessage $message;
    private ?Envelope $envelope;

    public function __construct(RawMessage $message, ?Envelope $envelope = null)
    {
        $this->message = $message;
        $this->envelope = $envelope;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getMessage(): RawMessage
    {
        return $this->message;
    }

    public function getEnvelope(): ?Envelope
    {
        return $this->envelope;
    }
}
