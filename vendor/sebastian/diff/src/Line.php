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

final class Line
{
    public const ADDED     = 1;
<<<<<<< HEAD
    public const REMOVED   = 2;
    public const UNCHANGED = 3;
    private int $type;
    private string $content;
=======

    public const REMOVED   = 2;

    public const UNCHANGED = 3;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $content;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function __construct(int $type = self::UNCHANGED, string $content = '')
    {
        $this->type    = $type;
        $this->content = $content;
    }

<<<<<<< HEAD
    public function content(): string
    {
        return $this->content;
    }

    public function type(): int
    {
        return $this->type;
    }

    public function isAdded(): bool
    {
        return $this->type === self::ADDED;
    }

    public function isRemoved(): bool
    {
        return $this->type === self::REMOVED;
    }

    public function isUnchanged(): bool
    {
        return $this->type === self::UNCHANGED;
    }

    /**
     * @deprecated
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function getContent(): string
    {
        return $this->content;
    }

<<<<<<< HEAD
    /**
     * @deprecated
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function getType(): int
    {
        return $this->type;
    }
}
