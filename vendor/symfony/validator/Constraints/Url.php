<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

<<<<<<< HEAD
use Symfony\Component\Validator\Attribute\HasNamedArguments;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

/**
<<<<<<< HEAD
 * Validates that a value is a valid URL string.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Url extends Constraint
{
    public const INVALID_URL_ERROR = '57c2f299-1154-4870-89bb-ef3b1f5ad229';
<<<<<<< HEAD
    public const MISSING_TLD_ERROR = '8a5d387f-0716-46b4-844b-67367faf435a';

    protected const ERROR_NAMES = [
        self::INVALID_URL_ERROR => 'INVALID_URL_ERROR',
        self::MISSING_TLD_ERROR => 'MISSING_TLD_ERROR',
    ];

    public string $message = 'This value is not a valid URL.';
    public string $tldMessage = 'This URL is missing a top-level domain.';
    public array $protocols = ['http', 'https'];
    public bool $relativeProtocol = false;
    public bool $requireTld = false;
    /** @var callable|null */
    public $normalizer;

    /**
     * @param array<string,mixed>|null $options
     * @param string[]|null            $protocols        The protocols considered to be valid for the URL (e.g. http, https, ftp, etc.) (defaults to ['http', 'https']
     * @param bool|null                $relativeProtocol Whether to accept URL without the protocol (i.e. //example.com) (defaults to false)
     * @param string[]|null            $groups
     * @param bool|null                $requireTld       Whether to require the URL to include a top-level domain (defaults to false)
     */
    #[HasNamedArguments]
=======

    protected const ERROR_NAMES = [
        self::INVALID_URL_ERROR => 'INVALID_URL_ERROR',
    ];

    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value is not a valid URL.';
    public $protocols = ['http', 'https'];
    public $relativeProtocol = false;
    /** @var callable|null */
    public $normalizer;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?array $protocols = null,
        ?bool $relativeProtocol = null,
        ?callable $normalizer = null,
        ?array $groups = null,
        mixed $payload = null,
<<<<<<< HEAD
        ?bool $requireTld = null,
        ?string $tldMessage = null,
    ) {
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

        parent::__construct($options, $groups, $payload);

        if (null === ($options['requireTld'] ?? $requireTld)) {
            trigger_deprecation('symfony/validator', '7.1', 'Not passing a value for the "requireTld" option to the Url constraint is deprecated. Its default value will change to "true".');
        }

=======
    ) {
        parent::__construct($options, $groups, $payload);

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->message = $message ?? $this->message;
        $this->protocols = $protocols ?? $this->protocols;
        $this->relativeProtocol = $relativeProtocol ?? $this->relativeProtocol;
        $this->normalizer = $normalizer ?? $this->normalizer;
<<<<<<< HEAD
        $this->requireTld = $requireTld ?? $this->requireTld;
        $this->tldMessage = $tldMessage ?? $this->tldMessage;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        if (null !== $this->normalizer && !\is_callable($this->normalizer)) {
            throw new InvalidArgumentException(\sprintf('The "normalizer" option must be a valid callable ("%s" given).', get_debug_type($this->normalizer)));
        }
    }
}
