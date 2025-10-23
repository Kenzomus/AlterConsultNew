<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Extension;

use Twig\NodeVisitor\OptimizerNodeVisitor;

final class OptimizerExtension extends AbstractExtension
{
<<<<<<< HEAD
    public function __construct(
        private int $optimizers = -1,
    ) {
=======
    private $optimizers;

    public function __construct(int $optimizers = -1)
    {
        $this->optimizers = $optimizers;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getNodeVisitors(): array
    {
        return [new OptimizerNodeVisitor($this->optimizers)];
    }
}
