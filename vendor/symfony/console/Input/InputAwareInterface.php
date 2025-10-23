<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

/**
 * InputAwareInterface should be implemented by classes that depends on the
 * Console Input.
 *
 * @author Wouter J <waldio.webdesign@gmail.com>
 */
interface InputAwareInterface
{
    /**
     * Sets the Console Input.
<<<<<<< HEAD
     */
    public function setInput(InputInterface $input): void;
=======
     *
     * @return void
     */
    public function setInput(InputInterface $input);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
