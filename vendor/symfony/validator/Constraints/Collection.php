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
use Symfony\Component\Validator\Constraint;

/**
 * Validates a collection with constraints defined for specific keys.
=======
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Collection extends Composite
{
    public const MISSING_FIELD_ERROR = '2fa2158c-2a7f-484b-98aa-975522539ff8';
    public const NO_SUCH_FIELD_ERROR = '7703c766-b5d5-4cef-ace7-ae0dd82304e9';

    protected const ERROR_NAMES = [
        self::MISSING_FIELD_ERROR => 'MISSING_FIELD_ERROR',
        self::NO_SUCH_FIELD_ERROR => 'NO_SUCH_FIELD_ERROR',
    ];

<<<<<<< HEAD
    public array $fields = [];
    public bool $allowExtraFields = false;
    public bool $allowMissingFields = false;
    public string $extraFieldsMessage = 'This field was not expected.';
    public string $missingFieldsMessage = 'This field is missing.';

    /**
     * @param array<string,Constraint>|array<string,mixed>|null $fields             An associative array defining keys in the collection and their constraints
     * @param string[]|null                                     $groups
     * @param bool|null                                         $allowExtraFields   Whether to allow additional keys not declared in the configured fields (defaults to false)
     * @param bool|null                                         $allowMissingFields Whether to allow the collection to lack some fields declared in the configured fields (defaults to false)
     */
    #[HasNamedArguments]
    public function __construct(mixed $fields = null, ?array $groups = null, mixed $payload = null, ?bool $allowExtraFields = null, ?bool $allowMissingFields = null, ?string $extraFieldsMessage = null, ?string $missingFieldsMessage = null)
    {
        $options = $fields;

        if (self::isFieldsOption($fields)) {
            $options = [];

            if (null !== $fields) {
                $options['fields'] = $fields;
            }
        } else {
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
        }

        parent::__construct($options, $groups, $payload);
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $fields = [];
    public $allowExtraFields = false;
    public $allowMissingFields = false;
    public $extraFieldsMessage = 'This field was not expected.';
    public $missingFieldsMessage = 'This field is missing.';

    public function __construct(mixed $fields = null, ?array $groups = null, mixed $payload = null, ?bool $allowExtraFields = null, ?bool $allowMissingFields = null, ?string $extraFieldsMessage = null, ?string $missingFieldsMessage = null)
    {
        if (self::isFieldsOption($fields)) {
            $fields = ['fields' => $fields];
        }

        parent::__construct($fields, $groups, $payload);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        $this->allowExtraFields = $allowExtraFields ?? $this->allowExtraFields;
        $this->allowMissingFields = $allowMissingFields ?? $this->allowMissingFields;
        $this->extraFieldsMessage = $extraFieldsMessage ?? $this->extraFieldsMessage;
        $this->missingFieldsMessage = $missingFieldsMessage ?? $this->missingFieldsMessage;
    }

<<<<<<< HEAD
    protected function initializeNestedConstraints(): void
    {
        parent::initializeNestedConstraints();

=======
    /**
     * @return void
     */
    protected function initializeNestedConstraints()
    {
        parent::initializeNestedConstraints();

        if (!\is_array($this->fields)) {
            throw new ConstraintDefinitionException(\sprintf('The option "fields" is expected to be an array in constraint "%s".', __CLASS__));
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        foreach ($this->fields as $fieldName => $field) {
            // the XmlFileLoader and YamlFileLoader pass the field Optional
            // and Required constraint as an array with exactly one element
            if (\is_array($field) && 1 == \count($field)) {
                $this->fields[$fieldName] = $field = $field[0];
            }

            if (!$field instanceof Optional && !$field instanceof Required) {
                $this->fields[$fieldName] = new Required($field);
            }
        }
    }

    public function getRequiredOptions(): array
    {
        return ['fields'];
    }

    protected function getCompositeOption(): string
    {
        return 'fields';
    }

    private static function isFieldsOption($options): bool
    {
<<<<<<< HEAD
        if (null === $options) {
            return true;
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if (!\is_array($options)) {
            return false;
        }

        foreach ($options as $optionOrField) {
            if ($optionOrField instanceof Constraint) {
                return true;
            }

            if (null === $optionOrField) {
                continue;
            }

            if (!\is_array($optionOrField)) {
                return false;
            }

            if ($optionOrField && !($optionOrField[0] ?? null) instanceof Constraint) {
                return false;
            }
        }

        return true;
    }
}
