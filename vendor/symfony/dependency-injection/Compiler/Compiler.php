<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\EnvParameterException;

/**
 * This class is used to remove circular dependencies between individual passes.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Compiler
{
    private PassConfig $passConfig;
    private array $log = [];
    private ServiceReferenceGraph $serviceReferenceGraph;

    public function __construct()
    {
        $this->passConfig = new PassConfig();
        $this->serviceReferenceGraph = new ServiceReferenceGraph();
    }

    public function getPassConfig(): PassConfig
    {
        return $this->passConfig;
    }

    public function getServiceReferenceGraph(): ServiceReferenceGraph
    {
        return $this->serviceReferenceGraph;
    }

<<<<<<< HEAD
    public function addPass(CompilerPassInterface $pass, string $type = PassConfig::TYPE_BEFORE_OPTIMIZATION, int $priority = 0): void
=======
    /**
     * @return void
     */
    public function addPass(CompilerPassInterface $pass, string $type = PassConfig::TYPE_BEFORE_OPTIMIZATION, int $priority = 0)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->passConfig->addPass($pass, $type, $priority);
    }

    /**
     * @final
<<<<<<< HEAD
     */
    public function log(CompilerPassInterface $pass, string $message): void
=======
     *
     * @return void
     */
    public function log(CompilerPassInterface $pass, string $message)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (str_contains($message, "\n")) {
            $message = str_replace("\n", "\n".$pass::class.': ', trim($message));
        }

        $this->log[] = $pass::class.': '.$message;
    }

    public function getLog(): array
    {
        return $this->log;
    }

    /**
     * Run the Compiler and process all Passes.
<<<<<<< HEAD
     */
    public function compile(ContainerBuilder $container): void
=======
     *
     * @return void
     */
    public function compile(ContainerBuilder $container)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        try {
            foreach ($this->passConfig->getPasses() as $pass) {
                $pass->process($container);
            }
        } catch (\Exception $e) {
            $usedEnvs = [];
            $prev = $e;

            do {
                $msg = $prev->getMessage();

                if ($msg !== $resolvedMsg = $container->resolveEnvPlaceholders($msg, null, $usedEnvs)) {
                    $r = new \ReflectionProperty($prev, 'message');
                    $r->setValue($prev, $resolvedMsg);
                }
            } while ($prev = $prev->getPrevious());

            if ($usedEnvs) {
                $e = new EnvParameterException($usedEnvs, $e);
            }

            throw $e;
        } finally {
            $this->getServiceReferenceGraph()->clear();
        }
    }
}
