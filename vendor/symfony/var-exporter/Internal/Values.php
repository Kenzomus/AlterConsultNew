<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarExporter\Internal;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @internal
 */
class Values
{
<<<<<<< HEAD
    public function __construct(
        public readonly array $values,
    ) {
=======
    public $values;

    public function __construct(array $values)
    {
        $this->values = $values;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
