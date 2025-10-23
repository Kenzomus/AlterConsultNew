<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Represents a node in your service graph.
 *
 * Value is typically a definition, or an alias.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class ServiceReferenceGraphNode
{
<<<<<<< HEAD
    private array $inEdges = [];
    private array $outEdges = [];

    public function __construct(
        private string $id,
        private mixed $value,
    ) {
    }

    public function addInEdge(ServiceReferenceGraphEdge $edge): void
=======
    private string $id;
    private array $inEdges = [];
    private array $outEdges = [];
    private mixed $value;

    public function __construct(string $id, mixed $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * @return void
     */
    public function addInEdge(ServiceReferenceGraphEdge $edge)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->inEdges[] = $edge;
    }

<<<<<<< HEAD
    public function addOutEdge(ServiceReferenceGraphEdge $edge): void
=======
    /**
     * @return void
     */
    public function addOutEdge(ServiceReferenceGraphEdge $edge)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->outEdges[] = $edge;
    }

    /**
     * Checks if the value of this node is an Alias.
     */
    public function isAlias(): bool
    {
        return $this->value instanceof Alias;
    }

    /**
     * Checks if the value of this node is a Definition.
     */
    public function isDefinition(): bool
    {
        return $this->value instanceof Definition;
    }

    /**
     * Returns the identifier.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns the in edges.
     *
     * @return ServiceReferenceGraphEdge[]
     */
    public function getInEdges(): array
    {
        return $this->inEdges;
    }

    /**
     * Returns the out edges.
     *
     * @return ServiceReferenceGraphEdge[]
     */
    public function getOutEdges(): array
    {
        return $this->outEdges;
    }

    /**
     * Returns the value of this Node.
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * Clears all edges.
<<<<<<< HEAD
     */
    public function clear(): void
=======
     *
     * @return void
     */
    public function clear()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->inEdges = $this->outEdges = [];
    }
}
