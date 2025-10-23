<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Completion\Output;

use Symfony\Component\Console\Completion\CompletionSuggestions;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Guillaume Aveline <guillaume.aveline@pm.me>
 */
class FishCompletionOutput implements CompletionOutputInterface
{
    public function write(CompletionSuggestions $suggestions, OutputInterface $output): void
    {
<<<<<<< HEAD
        $values = [];
        foreach ($suggestions->getValueSuggestions() as $value) {
            $values[] = $value->getValue().($value->getDescription() ? "\t".$value->getDescription() : '');
        }
        foreach ($suggestions->getOptionSuggestions() as $option) {
            $values[] = '--'.$option->getName().($option->getDescription() ? "\t".$option->getDescription() : '');
            if ($option->isNegatable()) {
                $values[] = '--no-'.$option->getName().($option->getDescription() ? "\t".$option->getDescription() : '');
=======
        $values = $suggestions->getValueSuggestions();
        foreach ($suggestions->getOptionSuggestions() as $option) {
            $values[] = '--'.$option->getName();
            if ($option->isNegatable()) {
                $values[] = '--no-'.$option->getName();
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }
        $output->write(implode("\n", $values));
    }
}
