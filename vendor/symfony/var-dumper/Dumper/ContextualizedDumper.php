<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Dumper;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\ContextProvider\ContextProviderInterface;

/**
 * @author Kévin Thérage <therage.kevin@gmail.com>
 */
class ContextualizedDumper implements DataDumperInterface
{
<<<<<<< HEAD
    /**
     * @param ContextProviderInterface[] $contextProviders
     */
    public function __construct(
        private DataDumperInterface $wrappedDumper,
        private array $contextProviders,
    ) {
    }

    public function dump(Data $data): ?string
=======
    private DataDumperInterface $wrappedDumper;
    private array $contextProviders;

    /**
     * @param ContextProviderInterface[] $contextProviders
     */
    public function __construct(DataDumperInterface $wrappedDumper, array $contextProviders)
    {
        $this->wrappedDumper = $wrappedDumper;
        $this->contextProviders = $contextProviders;
    }

    /**
     * @return string|null
     */
    public function dump(Data $data)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $context = $data->getContext();
        foreach ($this->contextProviders as $contextProvider) {
            $context[$contextProvider::class] = $contextProvider->getContext();
        }

        return $this->wrappedDumper->dump($data->withContext($context));
    }
}
