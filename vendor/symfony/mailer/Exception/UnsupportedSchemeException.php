<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mailer\Exception;

use Symfony\Component\Mailer\Bridge;
use Symfony\Component\Mailer\Transport\Dsn;

/**
 * @author Konstantin Myakshin <molodchick@gmail.com>
 */
class UnsupportedSchemeException extends LogicException
{
    private const SCHEME_TO_PACKAGE_MAP = [
<<<<<<< HEAD
        'ahasend' => [
            'class' => Bridge\AhaSend\Transport\AhaSendTransportFactory::class,
            'package' => 'symfony/aha-send-mailer',
        ],
        'azure' => [
            'class' => Bridge\Azure\Transport\AzureTransportFactory::class,
            'package' => 'symfony/azure-mailer',
        ],
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        'brevo' => [
            'class' => Bridge\Brevo\Transport\BrevoTransportFactory::class,
            'package' => 'symfony/brevo-mailer',
        ],
        'gmail' => [
            'class' => Bridge\Google\Transport\GmailTransportFactory::class,
            'package' => 'symfony/google-mailer',
        ],
        'infobip' => [
            'class' => Bridge\Infobip\Transport\InfobipTransportFactory::class,
            'package' => 'symfony/infobip-mailer',
        ],
        'mailersend' => [
            'class' => Bridge\MailerSend\Transport\MailerSendTransportFactory::class,
            'package' => 'symfony/mailersend-mailer',
        ],
        'mailgun' => [
            'class' => Bridge\Mailgun\Transport\MailgunTransportFactory::class,
            'package' => 'symfony/mailgun-mailer',
        ],
        'mailjet' => [
            'class' => Bridge\Mailjet\Transport\MailjetTransportFactory::class,
            'package' => 'symfony/mailjet-mailer',
        ],
<<<<<<< HEAD
        'mailomat' => [
            'class' => Bridge\Mailomat\Transport\MailomatTransportFactory::class,
            'package' => 'symfony/mailomat-mailer',
        ],
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        'mailpace' => [
            'class' => Bridge\MailPace\Transport\MailPaceTransportFactory::class,
            'package' => 'symfony/mail-pace-mailer',
        ],
        'mandrill' => [
            'class' => Bridge\Mailchimp\Transport\MandrillTransportFactory::class,
            'package' => 'symfony/mailchimp-mailer',
        ],
<<<<<<< HEAD
        'postal' => [
            'class' => Bridge\Postal\Transport\PostalTransportFactory::class,
            'package' => 'symfony/postal-mailer',
=======
        'ohmysmtp' => [
            'class' => Bridge\OhMySmtp\Transport\OhMySmtpTransportFactory::class,
            'package' => 'symfony/oh-my-smtp-mailer',
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ],
        'postmark' => [
            'class' => Bridge\Postmark\Transport\PostmarkTransportFactory::class,
            'package' => 'symfony/postmark-mailer',
        ],
<<<<<<< HEAD
        'mailtrap' => [
            'class' => Bridge\Mailtrap\Transport\MailtrapTransportFactory::class,
            'package' => 'symfony/mailtrap-mailer',
        ],
        'resend' => [
            'class' => Bridge\Resend\Transport\ResendTransportFactory::class,
            'package' => 'symfony/resend-mailer',
        ],
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        'scaleway' => [
            'class' => Bridge\Scaleway\Transport\ScalewayTransportFactory::class,
            'package' => 'symfony/scaleway-mailer',
        ],
        'sendgrid' => [
            'class' => Bridge\Sendgrid\Transport\SendgridTransportFactory::class,
            'package' => 'symfony/sendgrid-mailer',
        ],
<<<<<<< HEAD
=======
        'sendinblue' => [
            'class' => Bridge\Sendinblue\Transport\SendinblueTransportFactory::class,
            'package' => 'symfony/sendinblue-mailer',
        ],
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        'ses' => [
            'class' => Bridge\Amazon\Transport\SesTransportFactory::class,
            'package' => 'symfony/amazon-mailer',
        ],
<<<<<<< HEAD
        'sweego' => [
            'class' => Bridge\Sweego\Transport\SweegoTransportFactory::class,
            'package' => 'symfony/sweego-mailer',
        ],
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ];

    public function __construct(Dsn $dsn, ?string $name = null, array $supported = [])
    {
        $provider = $dsn->getScheme();
        if (false !== $pos = strpos($provider, '+')) {
            $provider = substr($provider, 0, $pos);
        }
        $package = self::SCHEME_TO_PACKAGE_MAP[$provider] ?? null;
        if ($package && !class_exists($package['class'])) {
            parent::__construct(\sprintf('Unable to send emails via "%s" as the bridge is not installed. Try running "composer require %s".', $provider, $package['package']));

            return;
        }

        $message = \sprintf('The "%s" scheme is not supported', $dsn->getScheme());
        if ($name && $supported) {
            $message .= \sprintf('; supported schemes for mailer "%s" are: "%s"', $name, implode('", "', $supported));
        }

        parent::__construct($message.'.');
    }
}
