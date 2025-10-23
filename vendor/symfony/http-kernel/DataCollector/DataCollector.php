<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector;

use Symfony\Component\VarDumper\Caster\CutStub;
use Symfony\Component\VarDumper\Caster\ReflectionCaster;
use Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Cloner\Stub;
use Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * DataCollector.
 *
 * Children of this class must store the collected data in the data property.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@symfony.com>
 */
abstract class DataCollector implements DataCollectorInterface
{
<<<<<<< HEAD
    protected array|Data $data = [];
=======
    /**
     * @var array|Data
     */
    protected $data = [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    private ClonerInterface $cloner;

    /**
     * Converts the variable into a serializable Data instance.
     *
     * This array can be displayed in the template using
     * the VarDumper component.
     */
    protected function cloneVar(mixed $var): Data
    {
        if ($var instanceof Data) {
            return $var;
        }
        if (!isset($this->cloner)) {
            $this->cloner = new VarCloner();
            $this->cloner->setMaxItems(-1);
            $this->cloner->addCasters($this->getCasters());
        }

        return $this->cloner->cloneVar($var);
    }

    /**
     * @return callable[] The casters to add to the cloner
     */
<<<<<<< HEAD
    protected function getCasters(): array
    {
        return [
=======
    protected function getCasters()
    {
        $casters = [
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            '*' => function ($v, array $a, Stub $s, $isNested) {
                if (!$v instanceof Stub) {
                    $b = $a;
                    foreach ($a as $k => $v) {
                        if (!\is_object($v) || $v instanceof \DateTimeInterface || $v instanceof Stub) {
                            continue;
                        }

                        try {
                            $a[$k] = $s = new CutStub($v);

                            if ($b[$k] === $s) {
                                // we've hit a non-typed reference
                                $a[$k] = $v;
                            }
                        } catch (\TypeError $e) {
                            // we've hit a typed reference
                        }
                    }
                }

                return $a;
            },
        ] + ReflectionCaster::UNSET_CLOSURE_FILE_INFO;
<<<<<<< HEAD
=======

        return $casters;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function __sleep(): array
    {
        return ['data'];
    }

<<<<<<< HEAD
    public function __wakeup(): void
=======
    /**
     * @return void
     */
    public function __wakeup()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
    }

    /**
     * @internal to prevent implementing \Serializable
     */
    final protected function serialize(): void
    {
    }

    /**
     * @internal to prevent implementing \Serializable
     */
    final protected function unserialize(string $data): void
    {
    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->data = [];
    }
}
