<?php

namespace Doctrine\Common\Annotations;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

use function call_user_func_array;
use function get_class;

/**
 * Allows the reader to be used in-place of Doctrine's reader.
 */
class IndexedReader implements Reader
{
    /** @var Reader */
    private $delegate;

    public function __construct(Reader $reader)
    {
        $this->delegate = $reader;
    }

    /**
     * {@inheritDoc}
     */
    public function getClassAnnotations(ReflectionClass $class)
    {
        $annotations = [];
        foreach ($this->delegate->getClassAnnotations($class) as $annot) {
            $annotations[get_class($annot)] = $annot;
        }

        return $annotations;
    }

    /**
     * {@inheritDoc}
     */
    public function getClassAnnotation(ReflectionClass $class, $annotationName)
    {
        return $this->delegate->getClassAnnotation($class, $annotationName);
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodAnnotations(ReflectionMethod $method)
    {
        $annotations = [];
        foreach ($this->delegate->getMethodAnnotations($method) as $annot) {
            $annotations[get_class($annot)] = $annot;
        }

        return $annotations;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodAnnotation(ReflectionMethod $method, $annotationName)
    {
        return $this->delegate->getMethodAnnotation($method, $annotationName);
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyAnnotations(ReflectionProperty $property)
    {
        $annotations = [];
        foreach ($this->delegate->getPropertyAnnotations($property) as $annot) {
            $annotations[get_class($annot)] = $annot;
        }

        return $annotations;
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyAnnotation(ReflectionProperty $property, $annotationName)
    {
        return $this->delegate->getPropertyAnnotation($property, $annotationName);
    }

    /**
     * Proxies all methods to the delegate.
     *
<<<<<<< HEAD
=======
     * @param string  $method
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     * @param mixed[] $args
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function __call(string $method, array $args)
=======
    public function __call($method, $args)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return call_user_func_array([$this->delegate, $method], $args);
    }
}
