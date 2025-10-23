<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension as BaseExtension;

/**
 * Allow adding classes to the class cache.
 *
 * @author Fabien Potencier <fabien@symfony.com>
<<<<<<< HEAD
 *
 * @internal since Symfony 7.1, to be deprecated in 8.1; use Symfony\Component\DependencyInjection\Extension\Extension instead
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 */
abstract class Extension extends BaseExtension
{
    private array $annotatedClasses = [];

    /**
     * Gets the annotated classes to cache.
<<<<<<< HEAD
     *
     * @return string[]
     *
     * @deprecated since Symfony 7.1, to be removed in 8.0
     */
    public function getAnnotatedClassesToCompile(): array
    {
        trigger_deprecation('symfony/http-kernel', '7.1', 'The "%s()" method is deprecated since Symfony 7.1 and will be removed in 8.0.', __METHOD__);

=======
     */
    public function getAnnotatedClassesToCompile(): array
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        return $this->annotatedClasses;
    }

    /**
     * Adds annotated classes to the class cache.
     *
<<<<<<< HEAD
     * @param string[] $annotatedClasses An array of class patterns
     *
     * @deprecated since Symfony 7.1, to be removed in 8.0
     */
    public function addAnnotatedClassesToCompile(array $annotatedClasses): void
    {
        trigger_deprecation('symfony/http-kernel', '7.1', 'The "%s()" method is deprecated since Symfony 7.1 and will be removed in 8.0.', __METHOD__);

=======
     * @param array $annotatedClasses An array of class patterns
     *
     * @return void
     */
    public function addAnnotatedClassesToCompile(array $annotatedClasses)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->annotatedClasses = array_merge($this->annotatedClasses, $annotatedClasses);
    }
}
