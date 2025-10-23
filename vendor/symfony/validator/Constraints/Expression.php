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

use Symfony\Component\ExpressionLanguage\Expression as ExpressionObject;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
<<<<<<< HEAD
use Symfony\Component\Validator\Attribute\HasNamedArguments;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\LogicException;

/**
<<<<<<< HEAD
 * Validates a value using an expression from the Expression Language component.
 *
 * @see https://symfony.com/doc/current/components/expression_language.html
=======
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD", "ANNOTATION"})
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class Expression extends Constraint
{
    public const EXPRESSION_FAILED_ERROR = '6b3befbc-2f01-4ddf-be21-b57898905284';

    protected const ERROR_NAMES = [
        self::EXPRESSION_FAILED_ERROR => 'EXPRESSION_FAILED_ERROR',
    ];

<<<<<<< HEAD
    public string $message = 'This value is not valid.';
    public string|ExpressionObject|null $expression = null;
    public array $values = [];
    public bool $negate = true;

    /**
     * @param string|ExpressionObject|array<string,mixed>|null $expression The expression to evaluate
     * @param array<string,mixed>|null                         $values     The values of the custom variables used in the expression (defaults to an empty array)
     * @param string[]|null                                    $groups
     * @param array<string,mixed>|null                         $options
     * @param bool|null                                        $negate     Whether to fail if the expression evaluates to true (defaults to false)
     */
    #[HasNamedArguments]
=======
    /**
     * @deprecated since Symfony 6.1, use const ERROR_NAMES instead
     */
    protected static $errorNames = self::ERROR_NAMES;

    public $message = 'This value is not valid.';
    public $expression;
    public $values = [];
    public bool $negate = true;

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(
        string|ExpressionObject|array|null $expression,
        ?string $message = null,
        ?array $values = null,
        ?array $groups = null,
        mixed $payload = null,
<<<<<<< HEAD
        ?array $options = null,
=======
        array $options = [],
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ?bool $negate = null,
    ) {
        if (!class_exists(ExpressionLanguage::class)) {
            throw new LogicException(\sprintf('The "symfony/expression-language" component is required to use the "%s" constraint. Try running "composer require symfony/expression-language".', __CLASS__));
        }

        if (\is_array($expression)) {
<<<<<<< HEAD
            trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);

            $options = array_merge($expression, $options ?? []);
        } else {
            if (\is_array($options)) {
                trigger_deprecation('symfony/validator', '7.3', 'Passing an array of options to configure the "%s" constraint is deprecated, use named arguments instead.', static::class);
            } else {
                $options = [];
            }

            if (null !== $expression) {
                $options['value'] = $expression;
            }
=======
            $options = array_merge($expression, $options);
        } elseif (null !== $expression) {
            $options['value'] = $expression;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->values = $values ?? $this->values;
        $this->negate = $negate ?? $this->negate;
    }

    public function getDefaultOption(): ?string
    {
        return 'expression';
    }

    public function getRequiredOptions(): array
    {
        return ['expression'];
    }

    public function getTargets(): string|array
    {
        return [self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT];
    }

    public function validatedBy(): string
    {
        return 'validator.expression';
    }
}
