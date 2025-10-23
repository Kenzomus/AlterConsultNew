<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Descriptor;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Descriptor interface.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
interface DescriptorInterface
{
<<<<<<< HEAD
    public function describe(OutputInterface $output, object $object, array $options = []): void;
=======
    /**
     * @return void
     */
    public function describe(OutputInterface $output, object $object, array $options = []);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
