<?php

namespace Doctrine\Common\Annotations;

use Exception;
use Throwable;

use function get_class;
use function gettype;
use function implode;
use function is_object;
use function sprintf;

/**
 * Description of AnnotationException
 */
class AnnotationException extends Exception
{
    /**
     * Creates a new AnnotationException describing a Syntax error.
     *
<<<<<<< HEAD
     * @return AnnotationException
     */
    public static function syntaxError(string $message)
=======
     * @param string $message Exception message
     *
     * @return AnnotationException
     */
    public static function syntaxError($message)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return new self('[Syntax Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing a Semantical error.
     *
<<<<<<< HEAD
     * @return AnnotationException
     */
    public static function semanticalError(string $message)
=======
     * @param string $message Exception message
     *
     * @return AnnotationException
     */
    public static function semanticalError($message)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return new self('[Semantical Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing an error which occurred during
     * the creation of the annotation.
     *
<<<<<<< HEAD
     * @return AnnotationException
     */
    public static function creationError(string $message, ?Throwable $previous = null)
=======
     * @param string $message
     *
     * @return AnnotationException
     */
    public static function creationError($message, ?Throwable $previous = null)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return new self('[Creation Error] ' . $message, 0, $previous);
    }

    /**
     * Creates a new AnnotationException describing a type error.
     *
<<<<<<< HEAD
     * @return AnnotationException
     */
    public static function typeError(string $message)
=======
     * @param string $message
     *
     * @return AnnotationException
     */
    public static function typeError($message)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return new self('[Type Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing a constant semantical error.
     *
<<<<<<< HEAD
     * @return AnnotationException
     */
    public static function semanticalErrorConstants(string $identifier, ?string $context = null)
=======
     * @param string $identifier
     * @param string $context
     *
     * @return AnnotationException
     */
    public static function semanticalErrorConstants($identifier, $context = null)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return self::semanticalError(sprintf(
            "Couldn't find constant %s%s.",
            $identifier,
            $context ? ', ' . $context : ''
        ));
    }

    /**
     * Creates a new AnnotationException describing an type error of an attribute.
     *
<<<<<<< HEAD
     * @param mixed $actual
     *
     * @return AnnotationException
     */
    public static function attributeTypeError(
        string $attributeName,
        string $annotationName,
        string $context,
        string $expected,
        $actual
    ) {
=======
     * @param string $attributeName
     * @param string $annotationName
     * @param string $context
     * @param string $expected
     * @param mixed  $actual
     *
     * @return AnnotationException
     */
    public static function attributeTypeError($attributeName, $annotationName, $context, $expected, $actual)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        return self::typeError(sprintf(
            'Attribute "%s" of @%s declared on %s expects %s, but got %s.',
            $attributeName,
            $annotationName,
            $context,
            $expected,
            is_object($actual) ? 'an instance of ' . get_class($actual) : gettype($actual)
        ));
    }

    /**
     * Creates a new AnnotationException describing an required error of an attribute.
     *
<<<<<<< HEAD
     * @return AnnotationException
     */
    public static function requiredError(
        string $attributeName,
        string $annotationName,
        string $context,
        string $expected
    ) {
=======
     * @param string $attributeName
     * @param string $annotationName
     * @param string $context
     * @param string $expected
     *
     * @return AnnotationException
     */
    public static function requiredError($attributeName, $annotationName, $context, $expected)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        return self::typeError(sprintf(
            'Attribute "%s" of @%s declared on %s expects %s. This value should not be null.',
            $attributeName,
            $annotationName,
            $context,
            $expected
        ));
    }

    /**
     * Creates a new AnnotationException describing a invalid enummerator.
     *
<<<<<<< HEAD
     * @param mixed $given
     * @phpstan-param list<string> $available
     *
     * @return AnnotationException
     */
    public static function enumeratorError(
        string $attributeName,
        string $annotationName,
        string $context,
        array $available,
        $given
    ) {
=======
     * @param string $attributeName
     * @param string $annotationName
     * @param string $context
     * @param mixed  $given
     * @phpstan-param list<string>        $available
     *
     * @return AnnotationException
     */
    public static function enumeratorError($attributeName, $annotationName, $context, $available, $given)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        return new self(sprintf(
            '[Enum Error] Attribute "%s" of @%s declared on %s accepts only [%s], but got %s.',
            $attributeName,
            $annotationName,
            $context,
            implode(', ', $available),
            is_object($given) ? get_class($given) : $given
        ));
    }

    /** @return AnnotationException */
    public static function optimizerPlusSaveComments()
    {
        return new self(
            'You have to enable opcache.save_comments=1 or zend_optimizerplus.save_comments=1.'
        );
    }

    /** @return AnnotationException */
    public static function optimizerPlusLoadComments()
    {
        return new self(
            'You have to enable opcache.load_comments=1 or zend_optimizerplus.load_comments=1.'
        );
    }
}
