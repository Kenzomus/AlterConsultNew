<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

<<<<<<< HEAD
use Symfony\Component\Validator\Constraint;

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
abstract class Existence extends Composite
{
<<<<<<< HEAD
    public array|Constraint $constraints = [];
=======
    public $constraints = [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    public function getDefaultOption(): ?string
    {
        return 'constraints';
    }

    protected function getCompositeOption(): string
    {
        return 'constraints';
    }
}
