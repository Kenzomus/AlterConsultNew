<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Controller\ArgumentResolver;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
<<<<<<< HEAD
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NearMissValueResolverException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Serializer\Exception\UnexpectedPropertyException;
use Symfony\Component\Serializer\Exception\UnsupportedFormatException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints as Assert;
=======
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Exception\PartialDenormalizationException;
use Symfony\Component\Serializer\Exception\UnsupportedFormatException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author Konstantin Myakshin <molodchick@gmail.com>
 *
 * @final
 */
class RequestPayloadValueResolver implements ValueResolverInterface, EventSubscriberInterface
{
    /**
     * @see DenormalizerInterface::COLLECT_DENORMALIZATION_ERRORS
     */
    private const CONTEXT_DENORMALIZE = [
        'collect_denormalization_errors' => true,
    ];

    /**
     * @see DenormalizerInterface::COLLECT_DENORMALIZATION_ERRORS
     */
    private const CONTEXT_DESERIALIZE = [
        'collect_denormalization_errors' => true,
    ];

    public function __construct(
        private readonly SerializerInterface&DenormalizerInterface $serializer,
        private readonly ?ValidatorInterface $validator = null,
        private readonly ?TranslatorInterface $translator = null,
<<<<<<< HEAD
        private string $translationDomain = 'validators',
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $attribute = $argument->getAttributesOfType(MapQueryString::class, ArgumentMetadata::IS_INSTANCEOF)[0]
            ?? $argument->getAttributesOfType(MapRequestPayload::class, ArgumentMetadata::IS_INSTANCEOF)[0]
<<<<<<< HEAD
            ?? $argument->getAttributesOfType(MapUploadedFile::class, ArgumentMetadata::IS_INSTANCEOF)[0]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ?? null;

        if (!$attribute) {
            return [];
        }

<<<<<<< HEAD
        if (!$attribute instanceof MapUploadedFile && $argument->isVariadic()) {
            throw new \LogicException(\sprintf('Mapping variadic argument "$%s" is not supported.', $argument->getName()));
        }

        if ($attribute instanceof MapRequestPayload) {
            if ('array' === $argument->getType()) {
                if (!$attribute->type) {
                    throw new NearMissValueResolverException(\sprintf('Please set the $type argument of the #[%s] attribute to the type of the objects in the expected array.', MapRequestPayload::class));
                }
            } elseif ($attribute->type) {
                throw new NearMissValueResolverException(\sprintf('Please set its type to "array" when using argument $type of #[%s].', MapRequestPayload::class));
            }
        }

=======
        if ($argument->isVariadic()) {
            throw new \LogicException(\sprintf('Mapping variadic argument "$%s" is not supported.', $argument->getName()));
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $attribute->metadata = $argument;

        return [$attribute];
    }

    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $arguments = $event->getArguments();

        foreach ($arguments as $i => $argument) {
            if ($argument instanceof MapQueryString) {
<<<<<<< HEAD
                $payloadMapper = $this->mapQueryString(...);
                $validationFailedCode = $argument->validationFailedStatusCode;
            } elseif ($argument instanceof MapRequestPayload) {
                $payloadMapper = $this->mapRequestPayload(...);
                $validationFailedCode = $argument->validationFailedStatusCode;
            } elseif ($argument instanceof MapUploadedFile) {
                $payloadMapper = $this->mapUploadedFile(...);
=======
                $payloadMapper = 'mapQueryString';
                $validationFailedCode = $argument->validationFailedStatusCode;
            } elseif ($argument instanceof MapRequestPayload) {
                $payloadMapper = 'mapRequestPayload';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                $validationFailedCode = $argument->validationFailedStatusCode;
            } else {
                continue;
            }
            $request = $event->getRequest();

<<<<<<< HEAD
            if (!$argument->metadata->getType()) {
=======
            if (!$type = $argument->metadata->getType()) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                throw new \LogicException(\sprintf('Could not resolve the "$%s" controller argument: argument should be typed.', $argument->metadata->getName()));
            }

            if ($this->validator) {
                $violations = new ConstraintViolationList();
                try {
<<<<<<< HEAD
                    $payload = $payloadMapper($request, $argument->metadata, $argument);
=======
                    $payload = $this->$payloadMapper($request, $type, $argument);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                } catch (PartialDenormalizationException $e) {
                    $trans = $this->translator ? $this->translator->trans(...) : fn ($m, $p) => strtr($m, $p);
                    foreach ($e->getErrors() as $error) {
                        $parameters = [];
                        $template = 'This value was of an unexpected type.';
                        if ($expectedTypes = $error->getExpectedTypes()) {
                            $template = 'This value should be of type {{ type }}.';
                            $parameters['{{ type }}'] = implode('|', $expectedTypes);
                        }
                        if ($error->canUseMessageForUser()) {
                            $parameters['hint'] = $error->getMessage();
                        }
<<<<<<< HEAD
                        $message = $trans($template, $parameters, $this->translationDomain);
=======
                        $message = $trans($template, $parameters, 'validators');
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                        $violations->add(new ConstraintViolation($message, $template, $parameters, null, $error->getPath(), null));
                    }
                    $payload = $e->getData();
                }

                if (null !== $payload && !\count($violations)) {
<<<<<<< HEAD
                    $constraints = $argument->constraints ?? null;
                    if (\is_array($payload) && !empty($constraints) && !$constraints instanceof Assert\All) {
                        $constraints = new Assert\All($constraints);
                    }
                    $violations->addAll($this->validator->validate($payload, $constraints, $argument->validationGroups ?? null));
                }

                if (\count($violations)) {
                    throw HttpException::fromStatusCode($validationFailedCode, implode("\n", array_map(static fn ($e) => $e->getMessage(), iterator_to_array($violations))), new ValidationFailedException($payload, $violations));
                }
            } else {
                try {
                    $payload = $payloadMapper($request, $argument->metadata, $argument);
                } catch (PartialDenormalizationException $e) {
                    throw HttpException::fromStatusCode($validationFailedCode, implode("\n", array_map(static fn ($e) => $e->getMessage(), $e->getErrors())), $e);
=======
                    $violations->addAll($this->validator->validate($payload, null, $argument->validationGroups ?? null));
                }

                if (\count($violations)) {
                    throw new HttpException($validationFailedCode, implode("\n", array_map(static fn ($e) => $e->getMessage(), iterator_to_array($violations))), new ValidationFailedException($payload, $violations));
                }
            } else {
                try {
                    $payload = $this->$payloadMapper($request, $type, $argument);
                } catch (PartialDenormalizationException $e) {
                    throw new HttpException($validationFailedCode, implode("\n", array_map(static fn ($e) => $e->getMessage(), $e->getErrors())), $e);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                }
            }

            if (null === $payload) {
                $payload = match (true) {
                    $argument->metadata->hasDefaultValue() => $argument->metadata->getDefaultValue(),
                    $argument->metadata->isNullable() => null,
<<<<<<< HEAD
                    default => throw HttpException::fromStatusCode($validationFailedCode),
=======
                    default => throw new HttpException($validationFailedCode),
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                };
            }

            $arguments[$i] = $payload;
        }

        $event->setArguments($arguments);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => 'onKernelControllerArguments',
        ];
    }

<<<<<<< HEAD
    private function mapQueryString(Request $request, ArgumentMetadata $argument, MapQueryString $attribute): ?object
    {
        if (!($data = $request->query->all($attribute->key)) && ($argument->isNullable() || $argument->hasDefaultValue())) {
            return null;
        }

        return $this->serializer->denormalize($data, $argument->getType(), 'csv', $attribute->serializationContext + self::CONTEXT_DENORMALIZE + ['filter_bool' => true]);
    }

    private function mapRequestPayload(Request $request, ArgumentMetadata $argument, MapRequestPayload $attribute): object|array|null
    {
        if (null === $format = $request->getContentTypeFormat()) {
            throw new UnsupportedMediaTypeHttpException('Unsupported format.');
        }

        if ($attribute->acceptFormat && !\in_array($format, (array) $attribute->acceptFormat, true)) {
            throw new UnsupportedMediaTypeHttpException(\sprintf('Unsupported format, expects "%s", but "%s" given.', implode('", "', (array) $attribute->acceptFormat), $format));
        }

        if ('array' === $argument->getType() && null !== $attribute->type) {
            $type = $attribute->type.'[]';
        } else {
            $type = $argument->getType();
        }

        if ($data = $request->request->all()) {
            return $this->serializer->denormalize($data, $type, 'csv', $attribute->serializationContext + self::CONTEXT_DENORMALIZE + ('form' === $format ? ['filter_bool' => true] : []));
        }

        if ('' === ($data = $request->getContent()) && ($argument->isNullable() || $argument->hasDefaultValue())) {
=======
    private function mapQueryString(Request $request, string $type, MapQueryString $attribute): ?object
    {
        if (!$data = $request->query->all()) {
            return null;
        }

        return $this->serializer->denormalize($data, $type, 'csv', $attribute->serializationContext + self::CONTEXT_DENORMALIZE);
    }

    private function mapRequestPayload(Request $request, string $type, MapRequestPayload $attribute): ?object
    {
        if (null === $format = $request->getContentTypeFormat()) {
            throw new HttpException(Response::HTTP_UNSUPPORTED_MEDIA_TYPE, 'Unsupported format.');
        }

        if ($attribute->acceptFormat && !\in_array($format, (array) $attribute->acceptFormat, true)) {
            throw new HttpException(Response::HTTP_UNSUPPORTED_MEDIA_TYPE, \sprintf('Unsupported format, expects "%s", but "%s" given.', implode('", "', (array) $attribute->acceptFormat), $format));
        }

        if ($data = $request->request->all()) {
            return $this->serializer->denormalize($data, $type, 'csv', $attribute->serializationContext + self::CONTEXT_DENORMALIZE);
        }

        if ('' === $data = $request->getContent()) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            return null;
        }

        if ('form' === $format) {
<<<<<<< HEAD
            throw new BadRequestHttpException('Request payload contains invalid "form" data.');
=======
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'Request payload contains invalid "form" data.');
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        try {
            return $this->serializer->deserialize($data, $type, $format, self::CONTEXT_DESERIALIZE + $attribute->serializationContext);
        } catch (UnsupportedFormatException $e) {
<<<<<<< HEAD
            throw new UnsupportedMediaTypeHttpException(\sprintf('Unsupported format: "%s".', $format), $e);
        } catch (NotEncodableValueException $e) {
            throw new BadRequestHttpException(\sprintf('Request payload contains invalid "%s" data.', $format), $e);
        } catch (UnexpectedPropertyException $e) {
            throw new BadRequestHttpException(\sprintf('Request payload contains invalid "%s" property.', $e->property), $e);
        }
    }

    private function mapUploadedFile(Request $request, ArgumentMetadata $argument, MapUploadedFile $attribute): UploadedFile|array|null
    {
        if (!($files = $request->files->get($attribute->name ?? $argument->getName())) && ($argument->isNullable() || $argument->hasDefaultValue())) {
            return null;
        }

        return $files ?? ('array' === $argument->getType() ? [] : null);
    }
=======
            throw new HttpException(Response::HTTP_UNSUPPORTED_MEDIA_TYPE, \sprintf('Unsupported format: "%s".', $format), $e);
        } catch (NotEncodableValueException $e) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, \sprintf('Request payload contains invalid "%s" data.', $format), $e);
        }
    }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
