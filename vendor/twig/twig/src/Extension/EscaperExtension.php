<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

<<<<<<< HEAD
namespace Twig\Extension;

use Twig\Environment;
use Twig\FileExtensionEscapingStrategy;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Expression\Filter\RawFilter;
use Twig\Node\Node;
use Twig\NodeVisitor\EscaperNodeVisitor;
use Twig\Runtime\EscaperRuntime;
=======
namespace Twig\Extension {
use Twig\FileExtensionEscapingStrategy;
use Twig\NodeVisitor\EscaperNodeVisitor;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\TokenParser\AutoEscapeTokenParser;
use Twig\TwigFilter;

final class EscaperExtension extends AbstractExtension
{
<<<<<<< HEAD
    private $environment;
    private $escapers = [];
    private $escaper;
    private $defaultStrategy;
=======
    private $defaultStrategy;
    private $escapers = [];

    /** @internal */
    public $safeClasses = [];

    /** @internal */
    public $safeLookup = [];
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * @param string|false|callable $defaultStrategy An escaping strategy
     *
     * @see setDefaultStrategy()
     */
    public function __construct($defaultStrategy = 'html')
    {
        $this->setDefaultStrategy($defaultStrategy);
    }

    public function getTokenParsers(): array
    {
        return [new AutoEscapeTokenParser()];
    }

    public function getNodeVisitors(): array
    {
        return [new EscaperNodeVisitor()];
    }

    public function getFilters(): array
    {
        return [
<<<<<<< HEAD
            new TwigFilter('escape', [EscaperRuntime::class, 'escape'], ['is_safe_callback' => [self::class, 'escapeFilterIsSafe']]),
            new TwigFilter('e', [EscaperRuntime::class, 'escape'], ['is_safe_callback' => [self::class, 'escapeFilterIsSafe']]),
            new TwigFilter('raw', null, ['is_safe' => ['all'], 'node_class' => RawFilter::class]),
        ];
    }

    public function getLastModified(): int
    {
        return max(
            parent::getLastModified(),
            filemtime((new \ReflectionClass(EscaperRuntime::class))->getFileName()),
        );
    }

    /**
     * @deprecated since Twig 3.10
     */
    public function setEnvironment(Environment $environment): void
    {
        $triggerDeprecation = \func_num_args() > 1 ? func_get_arg(1) : true;
        if ($triggerDeprecation) {
            trigger_deprecation('twig/twig', '3.10', 'The "%s()" method is deprecated and not needed if you are using methods from "Twig\Runtime\EscaperRuntime".', __METHOD__);
        }

        $this->environment = $environment;
        $this->escaper = $environment->getRuntime(EscaperRuntime::class);
    }

    /**
     * @return void
     *
     * @deprecated since Twig 3.10
     */
    public function setEscaperRuntime(EscaperRuntime $escaper)
    {
        trigger_deprecation('twig/twig', '3.10', 'The "%s()" method is deprecated and not needed if you are using methods from "Twig\Runtime\EscaperRuntime".', __METHOD__);

        $this->escaper = $escaper;
    }

=======
            new TwigFilter('escape', 'twig_escape_filter', ['needs_environment' => true, 'is_safe_callback' => 'twig_escape_filter_is_safe']),
            new TwigFilter('e', 'twig_escape_filter', ['needs_environment' => true, 'is_safe_callback' => 'twig_escape_filter_is_safe']),
            new TwigFilter('raw', 'twig_raw_filter', ['is_safe' => ['all']]),
        ];
    }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    /**
     * Sets the default strategy to use when not defined by the user.
     *
     * The strategy can be a valid PHP callback that takes the template
     * name as an argument and returns the strategy to use.
     *
<<<<<<< HEAD
     * @param string|false|callable(string $templateName): string $defaultStrategy An escaping strategy
=======
     * @param string|false|callable $defaultStrategy An escaping strategy
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
     */
    public function setDefaultStrategy($defaultStrategy): void
    {
        if ('name' === $defaultStrategy) {
            $defaultStrategy = [FileExtensionEscapingStrategy::class, 'guess'];
        }

        $this->defaultStrategy = $defaultStrategy;
    }

    /**
     * Gets the default strategy to use when not defined by the user.
     *
     * @param string $name The template name
     *
     * @return string|false The default strategy to use for the template
     */
    public function getDefaultStrategy(string $name)
    {
        // disable string callables to avoid calling a function named html or js,
        // or any other upcoming escaping strategy
        if (!\is_string($this->defaultStrategy) && false !== $this->defaultStrategy) {
            return \call_user_func($this->defaultStrategy, $name);
        }

        return $this->defaultStrategy;
    }

    /**
     * Defines a new escaper to be used via the escape filter.
     *
<<<<<<< HEAD
     * @param string                                        $strategy The strategy name that should be used as a strategy in the escape call
     * @param callable(Environment, string, string): string $callable A valid PHP callable
     *
     * @return void
     *
     * @deprecated since Twig 3.10
     */
    public function setEscaper($strategy, callable $callable)
    {
        trigger_deprecation('twig/twig', '3.10', 'The "%s()" method is deprecated, use the "Twig\Runtime\EscaperRuntime::setEscaper()" method instead (be warned that Environment is not passed anymore to the callable).', __METHOD__);

        if (!isset($this->environment)) {
            throw new \LogicException(\sprintf('You must call "setEnvironment()" before calling "%s()".', __METHOD__));
        }

        $this->escapers[$strategy] = $callable;
        $callable = function ($string, $charset) use ($callable) {
            return $callable($this->environment, $string, $charset);
        };

        $this->escaper->setEscaper($strategy, $callable);
=======
     * @param string   $strategy The strategy name that should be used as a strategy in the escape call
     * @param callable $callable A valid PHP callable
     */
    public function setEscaper($strategy, callable $callable)
    {
        $this->escapers[$strategy] = $callable;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    }

    /**
     * Gets all defined escapers.
     *
<<<<<<< HEAD
     * @return array<string, callable(Environment, string, string): string> An array of escapers
     *
     * @deprecated since Twig 3.10
     */
    public function getEscapers()
    {
        trigger_deprecation('twig/twig', '3.10', 'The "%s()" method is deprecated, use the "Twig\Runtime\EscaperRuntime::getEscaper()" method instead.', __METHOD__);

        return $this->escapers;
    }

    /**
     * @return void
     *
     * @deprecated since Twig 3.10
     */
    public function setSafeClasses(array $safeClasses = [])
    {
        trigger_deprecation('twig/twig', '3.10', 'The "%s()" method is deprecated, use the "Twig\Runtime\EscaperRuntime::setSafeClasses()" method instead.', __METHOD__);

        if (!isset($this->escaper)) {
            throw new \LogicException(\sprintf('You must call "setEnvironment()" before calling "%s()".', __METHOD__));
        }

        $this->escaper->setSafeClasses($safeClasses);
    }

    /**
     * @return void
     *
     * @deprecated since Twig 3.10
     */
    public function addSafeClass(string $class, array $strategies)
    {
        trigger_deprecation('twig/twig', '3.10', 'The "%s()" method is deprecated, use the "Twig\Runtime\EscaperRuntime::addSafeClass()" method instead.', __METHOD__);

        if (!isset($this->escaper)) {
            throw new \LogicException(\sprintf('You must call "setEnvironment()" before calling "%s()".', __METHOD__));
        }

        $this->escaper->addSafeClass($class, $strategies);
    }

    /**
     * @internal
     *
     * @return array<string>
     */
    public static function escapeFilterIsSafe(Node $filterArgs)
    {
        foreach ($filterArgs as $arg) {
            if ($arg instanceof ConstantExpression) {
                return [$arg->getAttribute('value')];
            }

            return [];
        }

        return ['html'];
    }
}
=======
     * @return callable[] An array of escapers
     */
    public function getEscapers()
    {
        return $this->escapers;
    }

    public function setSafeClasses(array $safeClasses = [])
    {
        $this->safeClasses = [];
        $this->safeLookup = [];
        foreach ($safeClasses as $class => $strategies) {
            $this->addSafeClass($class, $strategies);
        }
    }

    public function addSafeClass(string $class, array $strategies)
    {
        $class = ltrim($class, '\\');
        if (!isset($this->safeClasses[$class])) {
            $this->safeClasses[$class] = [];
        }
        $this->safeClasses[$class] = array_merge($this->safeClasses[$class], $strategies);

        foreach ($strategies as $strategy) {
            $this->safeLookup[$strategy][$class] = true;
        }
    }
}
}

namespace {
use Twig\Environment;
use Twig\Error\RuntimeError;
use Twig\Extension\EscaperExtension;
use Twig\Markup;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;

/**
 * Marks a variable as being safe.
 *
 * @param string $string A PHP variable
 */
function twig_raw_filter($string)
{
    return $string;
}

/**
 * Escapes a string.
 *
 * @param mixed  $string     The value to be escaped
 * @param string $strategy   The escaping strategy
 * @param string $charset    The charset
 * @param bool   $autoescape Whether the function is called by the auto-escaping feature (true) or by the developer (false)
 *
 * @return string
 */
function twig_escape_filter(Environment $env, $string, $strategy = 'html', $charset = null, $autoescape = false)
{
    if ($autoescape && $string instanceof Markup) {
        return $string;
    }

    if (!\is_string($string)) {
        if (\is_object($string) && method_exists($string, '__toString')) {
            if ($autoescape) {
                $c = \get_class($string);
                $ext = $env->getExtension(EscaperExtension::class);
                if (!isset($ext->safeClasses[$c])) {
                    $ext->safeClasses[$c] = [];
                    foreach (class_parents($string) + class_implements($string) as $class) {
                        if (isset($ext->safeClasses[$class])) {
                            $ext->safeClasses[$c] = array_unique(array_merge($ext->safeClasses[$c], $ext->safeClasses[$class]));
                            foreach ($ext->safeClasses[$class] as $s) {
                                $ext->safeLookup[$s][$c] = true;
                            }
                        }
                    }
                }
                if (isset($ext->safeLookup[$strategy][$c]) || isset($ext->safeLookup['all'][$c])) {
                    return (string) $string;
                }
            }

            $string = (string) $string;
        } elseif (\in_array($strategy, ['html', 'js', 'css', 'html_attr', 'url'])) {
            return $string;
        }
    }

    if ('' === $string) {
        return '';
    }

    if (null === $charset) {
        $charset = $env->getCharset();
    }

    switch ($strategy) {
        case 'html':
            // see https://www.php.net/htmlspecialchars

            // Using a static variable to avoid initializing the array
            // each time the function is called. Moving the declaration on the
            // top of the function slow downs other escaping strategies.
            static $htmlspecialcharsCharsets = [
                'ISO-8859-1' => true, 'ISO8859-1' => true,
                'ISO-8859-15' => true, 'ISO8859-15' => true,
                'utf-8' => true, 'UTF-8' => true,
                'CP866' => true, 'IBM866' => true, '866' => true,
                'CP1251' => true, 'WINDOWS-1251' => true, 'WIN-1251' => true,
                '1251' => true,
                'CP1252' => true, 'WINDOWS-1252' => true, '1252' => true,
                'KOI8-R' => true, 'KOI8-RU' => true, 'KOI8R' => true,
                'BIG5' => true, '950' => true,
                'GB2312' => true, '936' => true,
                'BIG5-HKSCS' => true,
                'SHIFT_JIS' => true, 'SJIS' => true, '932' => true,
                'EUC-JP' => true, 'EUCJP' => true,
                'ISO8859-5' => true, 'ISO-8859-5' => true, 'MACROMAN' => true,
            ];

            if (isset($htmlspecialcharsCharsets[$charset])) {
                return htmlspecialchars($string, \ENT_QUOTES | \ENT_SUBSTITUTE, $charset);
            }

            if (isset($htmlspecialcharsCharsets[strtoupper($charset)])) {
                // cache the lowercase variant for future iterations
                $htmlspecialcharsCharsets[$charset] = true;

                return htmlspecialchars($string, \ENT_QUOTES | \ENT_SUBSTITUTE, $charset);
            }

            $string = twig_convert_encoding($string, 'UTF-8', $charset);
            $string = htmlspecialchars($string, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');

            return iconv('UTF-8', $charset, $string);

        case 'js':
            // escape all non-alphanumeric characters
            // into their \x or \uHHHH representations
            if ('UTF-8' !== $charset) {
                $string = twig_convert_encoding($string, 'UTF-8', $charset);
            }

            if (!preg_match('//u', $string)) {
                throw new RuntimeError('The string to escape is not a valid UTF-8 string.');
            }

            $string = preg_replace_callback('#[^a-zA-Z0-9,\._]#Su', function ($matches) {
                $char = $matches[0];

                /*
                 * A few characters have short escape sequences in JSON and JavaScript.
                 * Escape sequences supported only by JavaScript, not JSON, are omitted.
                 * \" is also supported but omitted, because the resulting string is not HTML safe.
                 */
                static $shortMap = [
                    '\\' => '\\\\',
                    '/' => '\\/',
                    "\x08" => '\b',
                    "\x0C" => '\f',
                    "\x0A" => '\n',
                    "\x0D" => '\r',
                    "\x09" => '\t',
                ];

                if (isset($shortMap[$char])) {
                    return $shortMap[$char];
                }

                $codepoint = mb_ord($char, 'UTF-8');
                if (0x10000 > $codepoint) {
                    return sprintf('\u%04X', $codepoint);
                }

                // Split characters outside the BMP into surrogate pairs
                // https://tools.ietf.org/html/rfc2781.html#section-2.1
                $u = $codepoint - 0x10000;
                $high = 0xD800 | ($u >> 10);
                $low = 0xDC00 | ($u & 0x3FF);

                return sprintf('\u%04X\u%04X', $high, $low);
            }, $string);

            if ('UTF-8' !== $charset) {
                $string = iconv('UTF-8', $charset, $string);
            }

            return $string;

        case 'css':
            if ('UTF-8' !== $charset) {
                $string = twig_convert_encoding($string, 'UTF-8', $charset);
            }

            if (!preg_match('//u', $string)) {
                throw new RuntimeError('The string to escape is not a valid UTF-8 string.');
            }

            $string = preg_replace_callback('#[^a-zA-Z0-9]#Su', function ($matches) {
                $char = $matches[0];

                return sprintf('\\%X ', 1 === \strlen($char) ? \ord($char) : mb_ord($char, 'UTF-8'));
            }, $string);

            if ('UTF-8' !== $charset) {
                $string = iconv('UTF-8', $charset, $string);
            }

            return $string;

        case 'html_attr':
            if ('UTF-8' !== $charset) {
                $string = twig_convert_encoding($string, 'UTF-8', $charset);
            }

            if (!preg_match('//u', $string)) {
                throw new RuntimeError('The string to escape is not a valid UTF-8 string.');
            }

            $string = preg_replace_callback('#[^a-zA-Z0-9,\.\-_]#Su', function ($matches) {
                /**
                 * This function is adapted from code coming from Zend Framework.
                 *
                 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (https://www.zend.com)
                 * @license   https://framework.zend.com/license/new-bsd New BSD License
                 */
                $chr = $matches[0];
                $ord = \ord($chr);

                /*
                 * The following replaces characters undefined in HTML with the
                 * hex entity for the Unicode replacement character.
                 */
                if (($ord <= 0x1F && "\t" != $chr && "\n" != $chr && "\r" != $chr) || ($ord >= 0x7F && $ord <= 0x9F)) {
                    return '&#xFFFD;';
                }

                /*
                 * Check if the current character to escape has a name entity we should
                 * replace it with while grabbing the hex value of the character.
                 */
                if (1 === \strlen($chr)) {
                    /*
                     * While HTML supports far more named entities, the lowest common denominator
                     * has become HTML5's XML Serialisation which is restricted to the those named
                     * entities that XML supports. Using HTML entities would result in this error:
                     *     XML Parsing Error: undefined entity
                     */
                    static $entityMap = [
                        34 => '&quot;', /* quotation mark */
                        38 => '&amp;',  /* ampersand */
                        60 => '&lt;',   /* less-than sign */
                        62 => '&gt;',   /* greater-than sign */
                    ];

                    if (isset($entityMap[$ord])) {
                        return $entityMap[$ord];
                    }

                    return sprintf('&#x%02X;', $ord);
                }

                /*
                 * Per OWASP recommendations, we'll use hex entities for any other
                 * characters where a named entity does not exist.
                 */
                return sprintf('&#x%04X;', mb_ord($chr, 'UTF-8'));
            }, $string);

            if ('UTF-8' !== $charset) {
                $string = iconv('UTF-8', $charset, $string);
            }

            return $string;

        case 'url':
            return rawurlencode($string);

        default:
            $escapers = $env->getExtension(EscaperExtension::class)->getEscapers();
            if (\array_key_exists($strategy, $escapers)) {
                return $escapers[$strategy]($env, $string, $charset);
            }

            $validStrategies = implode(', ', array_merge(['html', 'js', 'url', 'css', 'html_attr'], array_keys($escapers)));

            throw new RuntimeError(sprintf('Invalid escaping strategy "%s" (valid ones: %s).', $strategy, $validStrategies));
    }
}

/**
 * @internal
 */
function twig_escape_filter_is_safe(Node $filterArgs)
{
    foreach ($filterArgs as $arg) {
        if ($arg instanceof ConstantExpression) {
            return [$arg->getAttribute('value')];
        }

        return [];
    }

    return ['html'];
}
}
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
