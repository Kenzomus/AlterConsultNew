<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Error;

use Twig\Source;
use Twig\Template;

/**
 * Twig base exception.
 *
 * This exception class and its children must only be used when
 * an error occurs during the loading of a template, when a syntax error
 * is detected in a template, or when rendering a template. Other
 * errors must use regular PHP exception classes (like when the template
 * cache directory is not writable for instance).
 *
 * To help debugging template issues, this class tracks the original template
 * name and line where the error occurred.
 *
 * Whenever possible, you must set these information (original template name
 * and line number) yourself by passing them to the constructor. If some or all
 * these information are not available from where you throw the exception, then
<<<<<<< HEAD
 * this class will guess them automatically.
=======
 * this class will guess them automatically (when the line number is set to -1
 * and/or the name is set to null). As this is a costly operation, this
 * can be disabled by passing false for both the name and the line number
 * when creating a new instance of this class.
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Error extends \Exception
{
    private $lineno;
<<<<<<< HEAD
    private $rawMessage;
    private ?Source $source;
    private string $phpFile;
    private int $phpLine;
=======
    private $name;
    private $rawMessage;
    private $sourcePath;
    private $sourceCode;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Constructor.
     *
     * By default, automatic guessing is enabled.
     *
     * @param string      $message The error message
     * @param int         $lineno  The template line where the error occurred
     * @param Source|null $source  The source context where the error occurred
     */
<<<<<<< HEAD
    public function __construct(string $message, int $lineno = -1, ?Source $source = null, ?\Throwable $previous = null)
    {
        parent::__construct('', 0, $previous);

        $this->phpFile = $this->getFile();
        $this->phpLine = $this->getLine();
        $this->lineno = $lineno;
        $this->source = $source;
=======
    public function __construct(string $message, int $lineno = -1, Source $source = null, \Throwable $previous = null)
    {
        parent::__construct('', 0, $previous);

        if (null === $source) {
            $name = null;
        } else {
            $name = $source->getName();
            $this->sourceCode = $source->getCode();
            $this->sourcePath = $source->getPath();
        }

        $this->lineno = $lineno;
        $this->name = $name;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->rawMessage = $message;
        $this->updateRepr();
    }

    public function getRawMessage(): string
    {
        return $this->rawMessage;
    }

    public function getTemplateLine(): int
    {
        return $this->lineno;
    }

    public function setTemplateLine(int $lineno): void
    {
        $this->lineno = $lineno;
<<<<<<< HEAD
=======

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->updateRepr();
    }

    public function getSourceContext(): ?Source
    {
<<<<<<< HEAD
        return $this->source;
    }

    public function setSourceContext(?Source $source = null): void
    {
        $this->source = $source;
=======
        return $this->name ? new Source($this->sourceCode, $this->name, $this->sourcePath) : null;
    }

    public function setSourceContext(Source $source = null): void
    {
        if (null === $source) {
            $this->sourceCode = $this->name = $this->sourcePath = null;
        } else {
            $this->sourceCode = $source->getCode();
            $this->name = $source->getName();
            $this->sourcePath = $source->getPath();
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->updateRepr();
    }

    public function guess(): void
    {
<<<<<<< HEAD
        if ($this->lineno > -1) {
            return;
        }

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $this->guessTemplateInfo();
        $this->updateRepr();
    }

    public function appendMessage($rawMessage): void
    {
        $this->rawMessage .= $rawMessage;
        $this->updateRepr();
    }

    private function updateRepr(): void
    {
<<<<<<< HEAD
        if ($this->source && $this->source->getPath()) {
            // we only update the file and the line together
            $this->file = $this->source->getPath();
            if ($this->lineno > 0) {
                $this->line = $this->lineno;
            } else {
                $this->line = -1;
            }
        }

        $this->message = $this->rawMessage;
        $last = substr($this->message, -1);
        if ($punctuation = '.' === $last || '?' === $last ? $last : '') {
            $this->message = substr($this->message, 0, -1);
        }
        if ($this->source && $this->source->getName()) {
            $this->message .= \sprintf(' in "%s"', $this->source->getName());
        }
        if ($this->lineno > 0) {
            $this->message .= \sprintf(' at line %d', $this->lineno);
        }
        if ($punctuation) {
            $this->message .= $punctuation;
=======
        $this->message = $this->rawMessage;

        if ($this->sourcePath && $this->lineno > 0) {
            $this->file = $this->sourcePath;
            $this->line = $this->lineno;

            return;
        }

        $dot = false;
        if (str_ends_with($this->message, '.')) {
            $this->message = substr($this->message, 0, -1);
            $dot = true;
        }

        $questionMark = false;
        if (str_ends_with($this->message, '?')) {
            $this->message = substr($this->message, 0, -1);
            $questionMark = true;
        }

        if ($this->name) {
            if (\is_string($this->name) || (\is_object($this->name) && method_exists($this->name, '__toString'))) {
                $name = sprintf('"%s"', $this->name);
            } else {
                $name = json_encode($this->name);
            }
            $this->message .= sprintf(' in %s', $name);
        }

        if ($this->lineno && $this->lineno >= 0) {
            $this->message .= sprintf(' at line %d', $this->lineno);
        }

        if ($dot) {
            $this->message .= '.';
        }

        if ($questionMark) {
            $this->message .= '?';
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        }
    }

    private function guessTemplateInfo(): void
    {
<<<<<<< HEAD
        // $this->source is never null here (see guess() usage in Template)

        $this->lineno = 0;
        $template = null;
        $backtrace = debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS | \DEBUG_BACKTRACE_PROVIDE_OBJECT);
        foreach ($backtrace as $trace) {
            if (isset($trace['object']) && $trace['object'] instanceof Template && $this->source->getName() === $trace['object']->getTemplateName()) {
                $template = $trace['object'];

                break;
            }
        }

=======
        $template = null;
        $templateClass = null;

        $backtrace = debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS | \DEBUG_BACKTRACE_PROVIDE_OBJECT);
        foreach ($backtrace as $trace) {
            if (isset($trace['object']) && $trace['object'] instanceof Template) {
                $currentClass = \get_class($trace['object']);
                $isEmbedContainer = null === $templateClass ? false : str_starts_with($templateClass, $currentClass);
                if (null === $this->name || ($this->name == $trace['object']->getTemplateName() && !$isEmbedContainer)) {
                    $template = $trace['object'];
                    $templateClass = \get_class($trace['object']);
                }
            }
        }

        // update template name
        if (null !== $template && null === $this->name) {
            $this->name = $template->getTemplateName();
        }

        // update template path if any
        if (null !== $template && null === $this->sourcePath) {
            $src = $template->getSourceContext();
            $this->sourceCode = $src->getCode();
            $this->sourcePath = $src->getPath();
        }

        if (null === $template || $this->lineno > -1) {
            return;
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $r = new \ReflectionObject($template);
        $file = $r->getFileName();

        $exceptions = [$e = $this];
        while ($e = $e->getPrevious()) {
            $exceptions[] = $e;
        }

        while ($e = array_pop($exceptions)) {
            $traces = $e->getTrace();
<<<<<<< HEAD
            array_unshift($traces, ['file' => $e instanceof Error ? $e->phpFile : $e->getFile(), 'line' => $e instanceof Error ? $e->phpLine : $e->getLine()]);
=======
            array_unshift($traces, ['file' => $e->getFile(), 'line' => $e->getLine()]);

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            while ($trace = array_shift($traces)) {
                if (!isset($trace['file']) || !isset($trace['line']) || $file != $trace['file']) {
                    continue;
                }

                foreach ($template->getDebugInfo() as $codeLine => $templateLine) {
                    if ($codeLine <= $trace['line']) {
                        // update template line
                        $this->lineno = $templateLine;

                        return;
                    }
                }
            }
        }
    }
}
