<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Util;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TemplateDirIterator extends \IteratorIterator
{
    /**
<<<<<<< HEAD
     * @return string
=======
     * @return mixed
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return file_get_contents(parent::current());
    }

    /**
<<<<<<< HEAD
     * @return string
=======
     * @return mixed
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return (string) parent::key();
    }
}
