<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * This exception is thrown when a non-existent service is requested.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class ServiceNotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
<<<<<<< HEAD
    public function __construct(
        private string $id,
        private ?string $sourceId = null,
        ?\Throwable $previous = null,
        private array $alternatives = [],
        ?string $msg = null,
    ) {
=======
    private string $id;
    private ?string $sourceId;
    private array $alternatives;

    public function __construct(string $id, ?string $sourceId = null, ?\Throwable $previous = null, array $alternatives = [], ?string $msg = null)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        if (null !== $msg) {
            // no-op
        } elseif (null === $sourceId) {
            $msg = \sprintf('You have requested a non-existent service "%s".', $id);
        } else {
            $msg = \sprintf('The service "%s" has a dependency on a non-existent service "%s".', $sourceId, $id);
        }

        if ($alternatives) {
            if (1 == \count($alternatives)) {
                $msg .= ' Did you mean this: "';
            } else {
                $msg .= ' Did you mean one of these: "';
            }
            $msg .= implode('", "', $alternatives).'"?';
        }

        parent::__construct($msg, 0, $previous);
<<<<<<< HEAD
    }

    public function getId(): string
=======

        $this->id = $id;
        $this->sourceId = $sourceId;
        $this->alternatives = $alternatives;
    }

    /**
     * @return string
     */
    public function getId()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getSourceId(): ?string
=======
    /**
     * @return string|null
     */
    public function getSourceId()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->sourceId;
    }

<<<<<<< HEAD
    public function getAlternatives(): array
=======
    /**
     * @return array
     */
    public function getAlternatives()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->alternatives;
    }
}
