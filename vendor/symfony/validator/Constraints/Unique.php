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
 * Validates that all the elements of the given collection are unique.
=======
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Yevgeniy Zholkevskiy <zhenya.zholkevskiy@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Unique extends Constraint
{
    public const IS_NOT_UNIQUE = '7911c98d-b845-4da0-94b7-a8dac36bc55a';

    public array|string $fields = [];
<<<<<<< HEAD
    public ?string $errorPath = null;
    public bool $stopOnFirstError = true;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    protected const ERROR_NAMES = [
        self::IS_NOT_UNIQUE => 'IS_NOT_UNIQUE',
    ];

<<<<<<< HEAD
    public string $message = 'This collection should contain only unique elements.';
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This collection should contain only unique elements.';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /** @var callable|null */
    public $normalizer;

    /**
<<<<<<< HEAD
     * @param array<string,mixed>|null $options
     * @param string[]|null            $groups
     * @param string[]|string|null     $fields  Defines the key or keys in the collection that should be checked for uniqueness (defaults to null, which ensure uniqueness for all keys)
     */
    #[HasNamedArguments]
=======
     * @param array|string $fields the combination of fields that must contain unique values or a set of options
     */
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        ?array $options = null,
        ?string $message = null,
        ?callable $normalizer = null,
        ?array $groups = null,
        mixed $payload = null,
        array|string|null $fields = null,
<<<<<<< HEAD
        ?string $errorPath = null,
        ?bool $stopOnFirstError = null,
    ) {
        if (\is_array($options)) {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

=======
    ) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->normalizer = $normalizer ?? $this->normalizer;
        $this->fields = $fields ?? $this->fields;
<<<<<<< HEAD
        $this->errorPath = $errorPath ?? $this->errorPath;
        $this->stopOnFirstError = $stopOnFirstError ?? $this->stopOnFirstError;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        if (null !== $this->normalizer && !\is_callable($this->normalizer)) {
            throw new InvalidArgumentException(\sprintf('The "normalizer" option must be a valid callable ("%s" given).', get_debug_type($this->normalizer)));
        }
    }
}
