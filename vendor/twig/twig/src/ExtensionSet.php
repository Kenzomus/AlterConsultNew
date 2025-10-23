<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig;

use Twig\Error\RuntimeError;
<<<<<<< HEAD
use Twig\ExpressionParser\ExpressionParsers;
use Twig\ExpressionParser\Infix\BinaryOperatorExpressionParser;
use Twig\ExpressionParser\InfixAssociativity;
use Twig\ExpressionParser\InfixExpressionParserInterface;
use Twig\ExpressionParser\PrecedenceChange;
use Twig\ExpressionParser\Prefix\UnaryOperatorExpressionParser;
use Twig\Extension\AttributeExtension;
use Twig\Extension\ExtensionInterface;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\LastModifiedExtensionInterface;
use Twig\Extension\StagingExtension;
use Twig\Node\Expression\AbstractExpression;
=======
use Twig\Extension\ExtensionInterface;
use Twig\Extension\GlobalsInterface;
use Twig\Extension\StagingExtension;
use Twig\Node\Expression\Binary\AbstractBinary;
use Twig\Node\Expression\Unary\AbstractUnary;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\TokenParser\TokenParserInterface;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @internal
 */
final class ExtensionSet
{
    private $extensions;
    private $initialized = false;
    private $runtimeInitialized = false;
    private $staging;
    private $parsers;
    private $visitors;
    /** @var array<string, TwigFilter> */
    private $filters;
<<<<<<< HEAD
    /** @var array<string, TwigFilter> */
    private $dynamicFilters;
    /** @var array<string, TwigTest> */
    private $tests;
    /** @var array<string, TwigTest> */
    private $dynamicTests;
    /** @var array<string, TwigFunction> */
    private $functions;
    /** @var array<string, TwigFunction> */
    private $dynamicFunctions;
    private ExpressionParsers $expressionParsers;
    /** @var array<string, mixed>|null */
    private $globals;
    /** @var array<callable(string): (TwigFunction|false)> */
    private $functionCallbacks = [];
    /** @var array<callable(string): (TwigFilter|false)> */
    private $filterCallbacks = [];
    /** @var array<callable(string): (TokenParserInterface|false)> */
=======
    /** @var array<string, TwigTest> */
    private $tests;
    /** @var array<string, TwigFunction> */
    private $functions;
    /** @var array<string, array{precedence: int, class: class-string<AbstractUnary>}> */
    private $unaryOperators;
    /** @var array<string, array{precedence: int, class: class-string<AbstractBinary>, associativity: ExpressionParser::OPERATOR_*}> */
    private $binaryOperators;
    /** @var array<string, mixed> */
    private $globals;
    private $functionCallbacks = [];
    private $filterCallbacks = [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    private $parserCallbacks = [];
    private $lastModified = 0;

    public function __construct()
    {
        $this->staging = new StagingExtension();
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function initRuntime()
    {
        $this->runtimeInitialized = true;
    }

    public function hasExtension(string $class): bool
    {
        return isset($this->extensions[ltrim($class, '\\')]);
    }

    public function getExtension(string $class): ExtensionInterface
    {
        $class = ltrim($class, '\\');

        if (!isset($this->extensions[$class])) {
<<<<<<< HEAD
            throw new RuntimeError(\sprintf('The "%s" extension is not enabled.', $class));
=======
            throw new RuntimeError(sprintf('The "%s" extension is not enabled.', $class));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        return $this->extensions[$class];
    }

    /**
     * @param ExtensionInterface[] $extensions
     */
    public function setExtensions(array $extensions): void
    {
        foreach ($extensions as $extension) {
            $this->addExtension($extension);
        }
    }

    /**
     * @return ExtensionInterface[]
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }

    public function getSignature(): string
    {
        return json_encode(array_keys($this->extensions));
    }

    public function isInitialized(): bool
    {
        return $this->initialized || $this->runtimeInitialized;
    }

    public function getLastModified(): int
    {
        if (0 !== $this->lastModified) {
            return $this->lastModified;
        }

<<<<<<< HEAD
        $lastModified = 0;
        foreach ($this->extensions as $extension) {
            if ($extension instanceof LastModifiedExtensionInterface) {
                $lastModified = max($extension->getLastModified(), $lastModified);
            } else {
                $r = new \ReflectionObject($extension);
                if (is_file($r->getFileName())) {
                    $lastModified = max(filemtime($r->getFileName()), $lastModified);
                }
            }
        }

        return $this->lastModified = $lastModified;
=======
        foreach ($this->extensions as $extension) {
            $r = new \ReflectionObject($extension);
            if (is_file($r->getFileName()) && ($extensionTime = filemtime($r->getFileName())) > $this->lastModified) {
                $this->lastModified = $extensionTime;
            }
        }

        return $this->lastModified;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    public function addExtension(ExtensionInterface $extension): void
    {
<<<<<<< HEAD
        if ($extension instanceof AttributeExtension) {
            $class = $extension->getClass();
        } else {
            $class = $extension::class;
        }

        if ($this->initialized) {
            throw new \LogicException(\sprintf('Unable to register extension "%s" as extensions have already been initialized.', $class));
        }

        if (isset($this->extensions[$class])) {
            throw new \LogicException(\sprintf('Unable to register extension "%s" as it is already registered.', $class));
=======
        $class = \get_class($extension);

        if ($this->initialized) {
            throw new \LogicException(sprintf('Unable to register extension "%s" as extensions have already been initialized.', $class));
        }

        if (isset($this->extensions[$class])) {
            throw new \LogicException(sprintf('Unable to register extension "%s" as it is already registered.', $class));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $this->extensions[$class] = $extension;
    }

    public function addFunction(TwigFunction $function): void
    {
        if ($this->initialized) {
<<<<<<< HEAD
            throw new \LogicException(\sprintf('Unable to add function "%s" as extensions have already been initialized.', $function->getName()));
=======
            throw new \LogicException(sprintf('Unable to add function "%s" as extensions have already been initialized.', $function->getName()));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $this->staging->addFunction($function);
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        return $this->functions;
    }

    public function getFunction(string $name): ?TwigFunction
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        if (isset($this->functions[$name])) {
            return $this->functions[$name];
        }

<<<<<<< HEAD
        foreach ($this->dynamicFunctions as $pattern => $function) {
            if (preg_match($pattern, $name, $matches)) {
                array_shift($matches);

                return $function->withDynamicArguments($name, $function->getName(), $matches);
=======
        foreach ($this->functions as $pattern => $function) {
            $pattern = str_replace('\\*', '(.*?)', preg_quote($pattern, '#'), $count);

            if ($count && preg_match('#^'.$pattern.'$#', $name, $matches)) {
                array_shift($matches);
                $function->setArguments($matches);

                return $function;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }

        foreach ($this->functionCallbacks as $callback) {
            if (false !== $function = $callback($name)) {
                return $function;
            }
        }

        return null;
    }

<<<<<<< HEAD
    /**
     * @param callable(string): (TwigFunction|false) $callable
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function registerUndefinedFunctionCallback(callable $callable): void
    {
        $this->functionCallbacks[] = $callable;
    }

    public function addFilter(TwigFilter $filter): void
    {
        if ($this->initialized) {
<<<<<<< HEAD
            throw new \LogicException(\sprintf('Unable to add filter "%s" as extensions have already been initialized.', $filter->getName()));
=======
            throw new \LogicException(sprintf('Unable to add filter "%s" as extensions have already been initialized.', $filter->getName()));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $this->staging->addFilter($filter);
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        return $this->filters;
    }

    public function getFilter(string $name): ?TwigFilter
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        if (isset($this->filters[$name])) {
            return $this->filters[$name];
        }

<<<<<<< HEAD
        foreach ($this->dynamicFilters as $pattern => $filter) {
            if (preg_match($pattern, $name, $matches)) {
                array_shift($matches);

                return $filter->withDynamicArguments($name, $filter->getName(), $matches);
=======
        foreach ($this->filters as $pattern => $filter) {
            $pattern = str_replace('\\*', '(.*?)', preg_quote($pattern, '#'), $count);

            if ($count && preg_match('#^'.$pattern.'$#', $name, $matches)) {
                array_shift($matches);
                $filter->setArguments($matches);

                return $filter;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }

        foreach ($this->filterCallbacks as $callback) {
            if (false !== $filter = $callback($name)) {
                return $filter;
            }
        }

        return null;
    }

<<<<<<< HEAD
    /**
     * @param callable(string): (TwigFilter|false) $callable
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function registerUndefinedFilterCallback(callable $callable): void
    {
        $this->filterCallbacks[] = $callable;
    }

    public function addNodeVisitor(NodeVisitorInterface $visitor): void
    {
        if ($this->initialized) {
            throw new \LogicException('Unable to add a node visitor as extensions have already been initialized.');
        }

        $this->staging->addNodeVisitor($visitor);
    }

    /**
     * @return NodeVisitorInterface[]
     */
    public function getNodeVisitors(): array
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        return $this->visitors;
    }

    public function addTokenParser(TokenParserInterface $parser): void
    {
        if ($this->initialized) {
            throw new \LogicException('Unable to add a token parser as extensions have already been initialized.');
        }

        $this->staging->addTokenParser($parser);
    }

    /**
     * @return TokenParserInterface[]
     */
    public function getTokenParsers(): array
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        return $this->parsers;
    }

    public function getTokenParser(string $name): ?TokenParserInterface
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        if (isset($this->parsers[$name])) {
            return $this->parsers[$name];
        }

        foreach ($this->parserCallbacks as $callback) {
            if (false !== $parser = $callback($name)) {
                return $parser;
            }
        }

        return null;
    }

<<<<<<< HEAD
    /**
     * @param callable(string): (TokenParserInterface|false) $callable
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function registerUndefinedTokenParserCallback(callable $callable): void
    {
        $this->parserCallbacks[] = $callable;
    }

    /**
     * @return array<string, mixed>
     */
    public function getGlobals(): array
    {
        if (null !== $this->globals) {
            return $this->globals;
        }

        $globals = [];
        foreach ($this->extensions as $extension) {
            if (!$extension instanceof GlobalsInterface) {
                continue;
            }

<<<<<<< HEAD
            $globals = array_merge($globals, $extension->getGlobals());
=======
            $extGlobals = $extension->getGlobals();
            if (!\is_array($extGlobals)) {
                throw new \UnexpectedValueException(sprintf('"%s::getGlobals()" must return an array of globals.', \get_class($extension)));
            }

            $globals = array_merge($globals, $extGlobals);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        if ($this->initialized) {
            $this->globals = $globals;
        }

        return $globals;
    }

<<<<<<< HEAD
    public function resetGlobals(): void
    {
        $this->globals = null;
    }

    public function addTest(TwigTest $test): void
    {
        if ($this->initialized) {
            throw new \LogicException(\sprintf('Unable to add test "%s" as extensions have already been initialized.', $test->getName()));
=======
    public function addTest(TwigTest $test): void
    {
        if ($this->initialized) {
            throw new \LogicException(sprintf('Unable to add test "%s" as extensions have already been initialized.', $test->getName()));
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        $this->staging->addTest($test);
    }

    /**
     * @return TwigTest[]
     */
    public function getTests(): array
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        return $this->tests;
    }

    public function getTest(string $name): ?TwigTest
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        if (isset($this->tests[$name])) {
            return $this->tests[$name];
        }

<<<<<<< HEAD
        foreach ($this->dynamicTests as $pattern => $test) {
            if (preg_match($pattern, $name, $matches)) {
                array_shift($matches);

                return $test->withDynamicArguments($name, $test->getName(), $matches);
=======
        foreach ($this->tests as $pattern => $test) {
            $pattern = str_replace('\\*', '(.*?)', preg_quote($pattern, '#'), $count);

            if ($count) {
                if (preg_match('#^'.$pattern.'$#', $name, $matches)) {
                    array_shift($matches);
                    $test->setArguments($matches);

                    return $test;
                }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }

        return null;
    }

<<<<<<< HEAD
    public function getExpressionParsers(): ExpressionParsers
=======
    /**
     * @return array<string, array{precedence: int, class: class-string<AbstractUnary>}>
     */
    public function getUnaryOperators(): array
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

<<<<<<< HEAD
        return $this->expressionParsers;
=======
        return $this->unaryOperators;
    }

    /**
     * @return array<string, array{precedence: int, class: class-string<AbstractBinary>, associativity: ExpressionParser::OPERATOR_*}>
     */
    public function getBinaryOperators(): array
    {
        if (!$this->initialized) {
            $this->initExtensions();
        }

        return $this->binaryOperators;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    private function initExtensions(): void
    {
        $this->parsers = [];
        $this->filters = [];
        $this->functions = [];
        $this->tests = [];
<<<<<<< HEAD
        $this->dynamicFilters = [];
        $this->dynamicFunctions = [];
        $this->dynamicTests = [];
        $this->visitors = [];
        $this->expressionParsers = new ExpressionParsers();
=======
        $this->visitors = [];
        $this->unaryOperators = [];
        $this->binaryOperators = [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

        foreach ($this->extensions as $extension) {
            $this->initExtension($extension);
        }
        $this->initExtension($this->staging);
        // Done at the end only, so that an exception during initialization does not mark the environment as initialized when catching the exception
        $this->initialized = true;
    }

    private function initExtension(ExtensionInterface $extension): void
    {
        // filters
        foreach ($extension->getFilters() as $filter) {
<<<<<<< HEAD
            $this->filters[$name = $filter->getName()] = $filter;
            if (str_contains($name, '*')) {
                $this->dynamicFilters['#^'.str_replace('\\*', '(.*?)', preg_quote($name, '#')).'$#'] = $filter;
            }
=======
            $this->filters[$filter->getName()] = $filter;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        // functions
        foreach ($extension->getFunctions() as $function) {
<<<<<<< HEAD
            $this->functions[$name = $function->getName()] = $function;
            if (str_contains($name, '*')) {
                $this->dynamicFunctions['#^'.str_replace('\\*', '(.*?)', preg_quote($name, '#')).'$#'] = $function;
            }
=======
            $this->functions[$function->getName()] = $function;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        // tests
        foreach ($extension->getTests() as $test) {
<<<<<<< HEAD
            $this->tests[$name = $test->getName()] = $test;
            if (str_contains($name, '*')) {
                $this->dynamicTests['#^'.str_replace('\\*', '(.*?)', preg_quote($name, '#')).'$#'] = $test;
            }
=======
            $this->tests[$test->getName()] = $test;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }

        // token parsers
        foreach ($extension->getTokenParsers() as $parser) {
            if (!$parser instanceof TokenParserInterface) {
                throw new \LogicException('getTokenParsers() must return an array of \Twig\TokenParser\TokenParserInterface.');
            }

            $this->parsers[$parser->getTag()] = $parser;
        }

        // node visitors
        foreach ($extension->getNodeVisitors() as $visitor) {
            $this->visitors[] = $visitor;
        }

<<<<<<< HEAD
        // expression parsers
        if (method_exists($extension, 'getExpressionParsers')) {
            $this->expressionParsers->add($extension->getExpressionParsers());
        }

        $operators = $extension->getOperators();
        if (!\is_array($operators)) {
            throw new \InvalidArgumentException(\sprintf('"%s::getOperators()" must return an array with operators, got "%s".', $extension::class, get_debug_type($operators).(\is_resource($operators) ? '' : '#'.$operators)));
        }

        if (2 !== \count($operators)) {
            throw new \InvalidArgumentException(\sprintf('"%s::getOperators()" must return an array of 2 elements, got %d.', $extension::class, \count($operators)));
        }

        $expressionParsers = [];
        foreach ($operators[0] as $operator => $op) {
            $expressionParsers[] = new UnaryOperatorExpressionParser($op['class'], $operator, $op['precedence'], $op['precedence_change'] ?? null, '', $op['aliases'] ?? []);
        }
        foreach ($operators[1] as $operator => $op) {
            $op['associativity'] = match ($op['associativity']) {
                1 => InfixAssociativity::Left,
                2 => InfixAssociativity::Right,
                default => throw new \InvalidArgumentException(\sprintf('Invalid associativity "%s" for operator "%s".', $op['associativity'], $operator)),
            };

            if (isset($op['callable'])) {
                $expressionParsers[] = $this->convertInfixExpressionParser($op['class'], $operator, $op['precedence'], $op['associativity'], $op['precedence_change'] ?? null, $op['aliases'] ?? [], $op['callable']);
            } else {
                $expressionParsers[] = new BinaryOperatorExpressionParser($op['class'], $operator, $op['precedence'], $op['associativity'], $op['precedence_change'] ?? null, '', $op['aliases'] ?? []);
            }
        }

        if (\count($expressionParsers)) {
            trigger_deprecation('twig/twig', '3.21', \sprintf('Extension "%s" uses the old signature for "getOperators()", please implement "getExpressionParsers()" instead.', $extension::class));

            $this->expressionParsers->add($expressionParsers);
        }
    }

    private function convertInfixExpressionParser(string $nodeClass, string $operator, int $precedence, InfixAssociativity $associativity, ?PrecedenceChange $precedenceChange, array $aliases, callable $callable): InfixExpressionParserInterface
    {
        trigger_deprecation('twig/twig', '3.21', \sprintf('Using a non-ExpressionParserInterface object to define the "%s" binary operator is deprecated.', $operator));

        return new class($nodeClass, $operator, $precedence, $associativity, $precedenceChange, $aliases, $callable) extends BinaryOperatorExpressionParser {
            public function __construct(
                string $nodeClass,
                string $operator,
                int $precedence,
                InfixAssociativity $associativity = InfixAssociativity::Left,
                ?PrecedenceChange $precedenceChange = null,
                array $aliases = [],
                private $callable = null,
            ) {
                parent::__construct($nodeClass, $operator, $precedence, $associativity, $precedenceChange, $aliases);
            }

            public function parse(Parser $parser, AbstractExpression $expr, Token $token): AbstractExpression
            {
                return ($this->callable)($parser, $expr);
            }
        };
=======
        // operators
        if ($operators = $extension->getOperators()) {
            if (!\is_array($operators)) {
                throw new \InvalidArgumentException(sprintf('"%s::getOperators()" must return an array with operators, got "%s".', \get_class($extension), \is_object($operators) ? \get_class($operators) : \gettype($operators).(\is_resource($operators) ? '' : '#'.$operators)));
            }

            if (2 !== \count($operators)) {
                throw new \InvalidArgumentException(sprintf('"%s::getOperators()" must return an array of 2 elements, got %d.', \get_class($extension), \count($operators)));
            }

            $this->unaryOperators = array_merge($this->unaryOperators, $operators[0]);
            $this->binaryOperators = array_merge($this->binaryOperators, $operators[1]);
        }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }
}
