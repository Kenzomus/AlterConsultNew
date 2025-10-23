<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\CacheWarmer;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryCompiler;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;

<<<<<<< HEAD
trigger_deprecation('symfony/serializer', '7.3', 'The "%s" class is deprecated.', CompiledClassMetadataCacheWarmer::class);

/**
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
 *
 * @deprecated since Symfony 7.3
=======
/**
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 */
final class CompiledClassMetadataCacheWarmer implements CacheWarmerInterface
{
    public function __construct(
        private readonly array $classesToCompile,
        private readonly ClassMetadataFactoryInterface $classMetadataFactory,
        private readonly ClassMetadataFactoryCompiler $classMetadataFactoryCompiler,
        private readonly Filesystem $filesystem,
    ) {
    }

    public function warmUp(string $cacheDir, ?string $buildDir = null): array
    {
        $metadatas = [];

        foreach ($this->classesToCompile as $classToCompile) {
            $metadatas[] = $this->classMetadataFactory->getMetadataFor($classToCompile);
        }

        $code = $this->classMetadataFactoryCompiler->compile($metadatas);

        $this->filesystem->dumpFile("{$cacheDir}/serializer.class.metadata.php", $code);

        return [];
    }

    public function isOptional(): bool
    {
        return true;
    }
}
