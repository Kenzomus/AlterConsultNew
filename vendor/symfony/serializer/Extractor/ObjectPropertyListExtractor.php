<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Extractor;

use Symfony\Component\PropertyInfo\PropertyListExtractorInterface;

/**
 * @author David Maicher <mail@dmaicher.de>
 */
final class ObjectPropertyListExtractor implements ObjectPropertyListExtractorInterface
{
<<<<<<< HEAD
    private \Closure $objectClassResolver;

    public function __construct(
        private PropertyListExtractorInterface $propertyListExtractor,
        ?callable $objectClassResolver = null,
    ) {
=======
    private PropertyListExtractorInterface $propertyListExtractor;
    private \Closure $objectClassResolver;

    public function __construct(PropertyListExtractorInterface $propertyListExtractor, ?callable $objectClassResolver = null)
    {
        $this->propertyListExtractor = $propertyListExtractor;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->objectClassResolver = ($objectClassResolver ?? 'get_class')(...);
    }

    public function getProperties(object $object, array $context = []): ?array
    {
        $class = ($this->objectClassResolver)($object);

        return $this->propertyListExtractor->getProperties($class, $context);
    }
}
