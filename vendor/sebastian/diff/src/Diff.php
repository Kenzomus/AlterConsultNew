<?php declare(strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Diff;

<<<<<<< HEAD
use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @template-implements IteratorAggregate<int, Chunk>
 */
final class Diff implements IteratorAggregate
{
    /**
     * @psalm-var non-empty-string
     */
    private string $from;

    /**
     * @psalm-var non-empty-string
     */
    private string $to;

    /**
     * @psalm-var list<Chunk>
     */
    private array $chunks;

    /**
     * @psalm-param non-empty-string $from
     * @psalm-param non-empty-string $to
     * @psalm-param list<Chunk> $chunks
=======
final class Diff
{
    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var Chunk[]
     */
    private $chunks;

    /**
     * @param Chunk[] $chunks
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function __construct(string $from, string $to, array $chunks = [])
    {
        $this->from   = $from;
        $this->to     = $to;
        $this->chunks = $chunks;
    }

<<<<<<< HEAD
    /**
     * @psalm-return non-empty-string
     */
    public function from(): string
    {
        return $this->from;
    }

    /**
     * @psalm-return non-empty-string
     */
    public function to(): string
    {
        return $this->to;
    }

    /**
     * @psalm-return list<Chunk>
     */
    public function chunks(): array
    {
        return $this->chunks;
    }

    /**
     * @psalm-param list<Chunk> $chunks
     */
    public function setChunks(array $chunks): void
    {
        $this->chunks = $chunks;
    }

    /**
     * @psalm-return non-empty-string
     *
     * @deprecated
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function getFrom(): string
    {
        return $this->from;
    }

<<<<<<< HEAD
    /**
     * @psalm-return non-empty-string
     *
     * @deprecated
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function getTo(): string
    {
        return $this->to;
    }

    /**
<<<<<<< HEAD
     * @psalm-return list<Chunk>
     *
     * @deprecated
=======
     * @return Chunk[]
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function getChunks(): array
    {
        return $this->chunks;
    }

<<<<<<< HEAD
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->chunks);
=======
    /**
     * @param Chunk[] $chunks
     */
    public function setChunks(array $chunks): void
    {
        $this->chunks = $chunks;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
