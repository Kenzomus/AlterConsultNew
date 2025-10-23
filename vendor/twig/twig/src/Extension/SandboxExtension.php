<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Extension;

use Twig\NodeVisitor\SandboxNodeVisitor;
use Twig\Sandbox\SecurityNotAllowedMethodError;
use Twig\Sandbox\SecurityNotAllowedPropertyError;
use Twig\Sandbox\SecurityPolicyInterface;
<<<<<<< HEAD
use Twig\Sandbox\SourcePolicyInterface;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Source;
use Twig\TokenParser\SandboxTokenParser;

final class SandboxExtension extends AbstractExtension
{
    private $sandboxedGlobally;
    private $sandboxed;
    private $policy;
<<<<<<< HEAD
    private $sourcePolicy;

    public function __construct(SecurityPolicyInterface $policy, $sandboxed = false, ?SourcePolicyInterface $sourcePolicy = null)
    {
        $this->policy = $policy;
        $this->sandboxedGlobally = $sandboxed;
        $this->sourcePolicy = $sourcePolicy;
=======

    public function __construct(SecurityPolicyInterface $policy, $sandboxed = false)
    {
        $this->policy = $policy;
        $this->sandboxedGlobally = $sandboxed;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function getTokenParsers(): array
    {
        return [new SandboxTokenParser()];
    }

    public function getNodeVisitors(): array
    {
        return [new SandboxNodeVisitor()];
    }

    public function enableSandbox(): void
    {
        $this->sandboxed = true;
    }

    public function disableSandbox(): void
    {
        $this->sandboxed = false;
    }

<<<<<<< HEAD
    public function isSandboxed(?Source $source = null): bool
    {
        return $this->sandboxedGlobally || $this->sandboxed || $this->isSourceSandboxed($source);
=======
    public function isSandboxed(): bool
    {
        return $this->sandboxedGlobally || $this->sandboxed;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function isSandboxedGlobally(): bool
    {
        return $this->sandboxedGlobally;
    }

<<<<<<< HEAD
    private function isSourceSandboxed(?Source $source): bool
    {
        if (null === $source || null === $this->sourcePolicy) {
            return false;
        }

        return $this->sourcePolicy->enableSandbox($source);
    }

    public function setSecurityPolicy(SecurityPolicyInterface $policy): void
=======
    public function setSecurityPolicy(SecurityPolicyInterface $policy)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        $this->policy = $policy;
    }

    public function getSecurityPolicy(): SecurityPolicyInterface
    {
        return $this->policy;
    }

<<<<<<< HEAD
    public function checkSecurity($tags, $filters, $functions, ?Source $source = null): void
    {
        if ($this->isSandboxed($source)) {
=======
    public function checkSecurity($tags, $filters, $functions): void
    {
        if ($this->isSandboxed()) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $this->policy->checkSecurity($tags, $filters, $functions);
        }
    }

<<<<<<< HEAD
    public function checkMethodAllowed($obj, $method, int $lineno = -1, ?Source $source = null): void
    {
        if ($this->isSandboxed($source)) {
=======
    public function checkMethodAllowed($obj, $method, int $lineno = -1, Source $source = null): void
    {
        if ($this->isSandboxed()) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            try {
                $this->policy->checkMethodAllowed($obj, $method);
            } catch (SecurityNotAllowedMethodError $e) {
                $e->setSourceContext($source);
                $e->setTemplateLine($lineno);

                throw $e;
            }
        }
    }

<<<<<<< HEAD
    public function checkPropertyAllowed($obj, $property, int $lineno = -1, ?Source $source = null): void
    {
        if ($this->isSandboxed($source)) {
=======
    public function checkPropertyAllowed($obj, $property, int $lineno = -1, Source $source = null): void
    {
        if ($this->isSandboxed()) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            try {
                $this->policy->checkPropertyAllowed($obj, $property);
            } catch (SecurityNotAllowedPropertyError $e) {
                $e->setSourceContext($source);
                $e->setTemplateLine($lineno);

                throw $e;
            }
        }
    }

<<<<<<< HEAD
    /**
     * @throws SecurityNotAllowedMethodError
     */
    public function ensureToStringAllowed($obj, int $lineno = -1, ?Source $source = null)
    {
        if (\is_array($obj)) {
            $this->ensureToStringAllowedForArray($obj, $lineno, $source);

            return $obj;
        }

        if ($obj instanceof \Stringable && $this->isSandboxed($source)) {
=======
    public function ensureToStringAllowed($obj, int $lineno = -1, Source $source = null)
    {
        if ($this->isSandboxed() && \is_object($obj) && method_exists($obj, '__toString')) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            try {
                $this->policy->checkMethodAllowed($obj, '__toString');
            } catch (SecurityNotAllowedMethodError $e) {
                $e->setSourceContext($source);
                $e->setTemplateLine($lineno);

                throw $e;
            }
        }

        return $obj;
    }
<<<<<<< HEAD

    private function ensureToStringAllowedForArray(array $obj, int $lineno, ?Source $source, array &$stack = []): void
    {
        foreach ($obj as $k => $v) {
            if (!$v) {
                continue;
            }

            if (!\is_array($v)) {
                $this->ensureToStringAllowed($v, $lineno, $source);
                continue;
            }

            if ($r = \ReflectionReference::fromArrayElement($obj, $k)) {
                if (isset($stack[$r->getId()])) {
                    continue;
                }

                $stack[$r->getId()] = true;
            }

            $this->ensureToStringAllowedForArray($v, $lineno, $source, $stack);
        }
    }
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
