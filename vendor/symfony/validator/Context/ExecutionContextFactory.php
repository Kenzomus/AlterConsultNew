<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Context;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Creates new {@link ExecutionContext} instances.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 *
<<<<<<< HEAD
 * @internal
 */
class ExecutionContextFactory implements ExecutionContextFactoryInterface
{
    public function __construct(
        private TranslatorInterface $translator,
        private string|false|null $translationDomain = null,
    ) {
=======
 * @internal version 2.5. Code against ExecutionContextFactoryInterface instead.
 */
class ExecutionContextFactory implements ExecutionContextFactoryInterface
{
    private TranslatorInterface $translator;
    private ?string $translationDomain;

    public function __construct(TranslatorInterface $translator, ?string $translationDomain = null)
    {
        $this->translator = $translator;
        $this->translationDomain = $translationDomain;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function createContext(ValidatorInterface $validator, mixed $root): ExecutionContextInterface
    {
        return new ExecutionContext(
            $validator,
            $root,
            $this->translator,
            $this->translationDomain
        );
    }
}
