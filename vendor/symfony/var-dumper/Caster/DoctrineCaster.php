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

use Doctrine\Common\Proxy\Proxy as CommonProxy;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Proxy\Proxy as OrmProxy;
use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * Casts Doctrine related classes to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @final
<<<<<<< HEAD
 *
 * @internal since Symfony 7.3
 */
class DoctrineCaster
{
    public static function castCommonProxy(CommonProxy $proxy, array $a, Stub $stub, bool $isNested): array
=======
 */
class DoctrineCaster
{
    /**
     * @return array
     */
    public static function castCommonProxy(CommonProxy $proxy, array $a, Stub $stub, bool $isNested)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach (['__cloner__', '__initializer__'] as $k) {
            if (\array_key_exists($k, $a)) {
                unset($a[$k]);
                ++$stub->cut;
            }
        }

        return $a;
    }

<<<<<<< HEAD
    public static function castOrmProxy(OrmProxy $proxy, array $a, Stub $stub, bool $isNested): array
=======
    /**
     * @return array
     */
    public static function castOrmProxy(OrmProxy $proxy, array $a, Stub $stub, bool $isNested)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach (['_entityPersister', '_identifier'] as $k) {
            if (\array_key_exists($k = "\0Doctrine\\ORM\\Proxy\\Proxy\0".$k, $a)) {
                unset($a[$k]);
                ++$stub->cut;
            }
        }

        return $a;
    }

<<<<<<< HEAD
    public static function castPersistentCollection(PersistentCollection $coll, array $a, Stub $stub, bool $isNested): array
=======
    /**
     * @return array
     */
    public static function castPersistentCollection(PersistentCollection $coll, array $a, Stub $stub, bool $isNested)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        foreach (['snapshot', 'association', 'typeClass'] as $k) {
            if (\array_key_exists($k = "\0Doctrine\\ORM\\PersistentCollection\0".$k, $a)) {
                $a[$k] = new CutStub($a[$k]);
            }
        }

        return $a;
    }
}
