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
final class BlackfireDumper
{
    public function dump(Profile $profile): string
    {
        $data = [];
        $this->dumpProfile('main()', $profile, $data);
        $this->dumpChildren('main()', $profile, $data);

<<<<<<< HEAD
        $start = \sprintf('%f', microtime(true));
=======
        $start = sprintf('%f', microtime(true));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $str = <<<EOF
file-format: BlackfireProbe
cost-dimensions: wt mu pmu
request-start: $start


EOF;

        foreach ($data as $name => $values) {
            $str .= "$name//{$values['ct']} {$values['wt']} {$values['mu']} {$values['pmu']}\n";
        }

        return $str;
    }

<<<<<<< HEAD
    private function dumpChildren(string $parent, Profile $profile, &$data): void
=======
    private function dumpChildren(string $parent, Profile $profile, &$data)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach ($profile as $p) {
            if ($p->isTemplate()) {
                $name = $p->getTemplate();
            } else {
<<<<<<< HEAD
                $name = \sprintf('%s::%s(%s)', $p->getTemplate(), $p->getType(), $p->getName());
            }
            $this->dumpProfile(\sprintf('%s==>%s', $parent, $name), $p, $data);
=======
                $name = sprintf('%s::%s(%s)', $p->getTemplate(), $p->getType(), $p->getName());
            }
            $this->dumpProfile(sprintf('%s==>%s', $parent, $name), $p, $data);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $this->dumpChildren($name, $p, $data);
        }
    }

<<<<<<< HEAD
    private function dumpProfile(string $edge, Profile $profile, &$data): void
=======
    private function dumpProfile(string $edge, Profile $profile, &$data)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (isset($data[$edge])) {
            ++$data[$edge]['ct'];
            $data[$edge]['wt'] += floor($profile->getDuration() * 1000000);
            $data[$edge]['mu'] += $profile->getMemoryUsage();
            $data[$edge]['pmu'] += $profile->getPeakMemoryUsage();
        } else {
            $data[$edge] = [
                'ct' => 1,
                'wt' => floor($profile->getDuration() * 1000000),
                'mu' => $profile->getMemoryUsage(),
                'pmu' => $profile->getPeakMemoryUsage(),
            ];
        }
    }
}
