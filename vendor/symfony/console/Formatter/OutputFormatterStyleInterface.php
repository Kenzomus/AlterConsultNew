<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Formatter;

/**
 * Formatter style interface for defining styles.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface OutputFormatterStyleInterface
{
    /**
     * Sets style foreground color.
<<<<<<< HEAD
     */
    public function setForeground(?string $color): void;

    /**
     * Sets style background color.
     */
    public function setBackground(?string $color): void;

    /**
     * Sets some specific style option.
     */
    public function setOption(string $option): void;

    /**
     * Unsets some specific style option.
     */
    public function unsetOption(string $option): void;

    /**
     * Sets multiple style options at once.
     */
    public function setOptions(array $options): void;
=======
     *
     * @return void
     */
    public function setForeground(?string $color);

    /**
     * Sets style background color.
     *
     * @return void
     */
    public function setBackground(?string $color);

    /**
     * Sets some specific style option.
     *
     * @return void
     */
    public function setOption(string $option);

    /**
     * Unsets some specific style option.
     *
     * @return void
     */
    public function unsetOption(string $option);

    /**
     * Sets multiple style options at once.
     *
     * @return void
     */
    public function setOptions(array $options);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Applies the style to a given text.
     */
    public function apply(string $text): string;
}
