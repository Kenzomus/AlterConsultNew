<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Profiler\Dumper;

use Twig\Profiler\Profile;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class TextDumper extends BaseDumper
{
    protected function formatTemplate(Profile $profile, $prefix): string
    {
<<<<<<< HEAD
        return \sprintf('%s└ %s', $prefix, $profile->getTemplate());
=======
        return sprintf('%s└ %s', $prefix, $profile->getTemplate());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    protected function formatNonTemplate(Profile $profile, $prefix): string
    {
<<<<<<< HEAD
        return \sprintf('%s└ %s::%s(%s)', $prefix, $profile->getTemplate(), $profile->getType(), $profile->getName());
=======
        return sprintf('%s└ %s::%s(%s)', $prefix, $profile->getTemplate(), $profile->getType(), $profile->getName());
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    protected function formatTime(Profile $profile, $percent): string
    {
<<<<<<< HEAD
        return \sprintf('%.2fms/%.0f%%', $profile->getDuration() * 1000, $percent);
=======
        return sprintf('%.2fms/%.0f%%', $profile->getDuration() * 1000, $percent);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
