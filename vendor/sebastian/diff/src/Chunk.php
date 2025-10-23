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
 * @template-implements IteratorAggregate<int, Line>
 */
final class Chunk implements IteratorAggregate
{
    private int $start;
    private int $startRange;
    private int $end;
    private int $endRange;
    private array $lines;
=======
final class Chunk
{
    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $startRange;

    /**
     * @var int
     */
    private $end;

    /**
     * @var int
     */
    private $endRange;

    /**
     * @var Line[]
     */
    private $lines;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct(int $start = 0, int $startRange = 1, int $end = 0, int $endRange = 1, array $lines = [])
    {
        $this->start      = $start;
        $this->startRange = $startRange;
        $this->end        = $end;
        $this->endRange   = $endRange;
        $this->lines      = $lines;
    }

<<<<<<< HEAD
    public function start(): int
=======
    public function getStart(): int
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->start;
    }

<<<<<<< HEAD
    public function startRange(): int
=======
    public function getStartRange(): int
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->startRange;
    }

<<<<<<< HEAD
    public function end(): int
=======
    public function getEnd(): int
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->end;
    }

<<<<<<< HEAD
    public function endRange(): int
=======
    public function getEndRange(): int
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->endRange;
    }

    /**
<<<<<<< HEAD
     * @psalm-return list<Line>
     */
    public function lines(): array
=======
     * @return Line[]
     */
    public function getLines(): array
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->lines;
    }

    /**
<<<<<<< HEAD
     * @psalm-param list<Line> $lines
=======
     * @param Line[] $lines
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function setLines(array $lines): void
    {
        foreach ($lines as $line) {
            if (!$line instanceof Line) {
                throw new InvalidArgumentException;
            }
        }

        $this->lines = $lines;
    }
<<<<<<< HEAD

    /**
     * @deprecated Use start() instead
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @deprecated Use startRange() instead
     */
    public function getStartRange(): int
    {
        return $this->startRange;
    }

    /**
     * @deprecated Use end() instead
     */
    public function getEnd(): int
    {
        return $this->end;
    }

    /**
     * @deprecated Use endRange() instead
     */
    public function getEndRange(): int
    {
        return $this->endRange;
    }

    /**
     * @psalm-return list<Line>
     *
     * @deprecated Use lines() instead
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->lines);
    }
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
