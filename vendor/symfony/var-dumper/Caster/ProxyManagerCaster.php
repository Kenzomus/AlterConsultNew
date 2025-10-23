<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

use ProxyManager\Proxy\ProxyInterface;
use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
<<<<<<< HEAD
 *
 * @internal since Symfony 7.3
 */
class ProxyManagerCaster
{
    public static function castProxy(ProxyInterface $c, array $a, Stub $stub, bool $isNested): array
=======
 */
class ProxyManagerCaster
{
    /**
     * @return array
     */
    public static function castProxy(ProxyInterface $c, array $a, Stub $stub, bool $isNested)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if ($parent = get_parent_class($c)) {
            $stub->class .= ' - '.$parent;
        }
        $stub->class .= '@proxy';

        return $a;
    }
}
