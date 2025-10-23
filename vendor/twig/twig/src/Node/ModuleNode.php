<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Node;

<<<<<<< HEAD
use Twig\Attribute\YieldReady;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Expression\ConstantExpression;
use Twig\Source;

/**
 * Represents a module node.
 *
<<<<<<< HEAD
 * If you need to customize the behavior of the generated class, add nodes to
 * the following nodes: display_start, display_end, constructor_start,
 * constructor_end, and class_end.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
#[YieldReady]
final class ModuleNode extends Node
{
    /**
     * @param BodyNode $body
     */
    public function __construct(Node $body, ?AbstractExpression $parent, Node $blocks, Node $macros, Node $traits, $embeddedTemplates, Source $source)
    {
        if (!$body instanceof BodyNode) {
            trigger_deprecation('twig/twig', '3.12', \sprintf('Not passing a "%s" instance as the "body" argument of the "%s" constructor is deprecated.', BodyNode::class, static::class));
        }
        if (!$embeddedTemplates instanceof Node) {
            trigger_deprecation('twig/twig', '3.21', \sprintf('Not passing a "%s" instance as the "embedded_templates" argument of the "%s" constructor is deprecated.', Node::class, static::class));

            if (null !== $embeddedTemplates) {
                $embeddedTemplates = new Nodes($embeddedTemplates);
            } else {
                $embeddedTemplates = new EmptyNode();
            }
        }

=======
 * Consider this class as being final. If you need to customize the behavior of
 * the generated class, consider adding nodes to the following nodes: display_start,
 * display_end, constructor_start, constructor_end, and class_end.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class ModuleNode extends Node
{
    public function __construct(Node $body, ?AbstractExpression $parent, Node $blocks, Node $macros, Node $traits, $embeddedTemplates, Source $source)
    {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $nodes = [
            'body' => $body,
            'blocks' => $blocks,
            'macros' => $macros,
            'traits' => $traits,
<<<<<<< HEAD
            'display_start' => new Nodes(),
            'display_end' => new Nodes(),
            'constructor_start' => new Nodes(),
            'constructor_end' => new Nodes(),
            'class_end' => new Nodes(),
=======
            'display_start' => new Node(),
            'display_end' => new Node(),
            'constructor_start' => new Node(),
            'constructor_end' => new Node(),
            'class_end' => new Node(),
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        ];
        if (null !== $parent) {
            $nodes['parent'] = $parent;
        }

        // embedded templates are set as attributes so that they are only visited once by the visitors
        parent::__construct($nodes, [
            'index' => null,
            'embedded_templates' => $embeddedTemplates,
        ], 1);

        // populate the template name of all node children
        $this->setSourceContext($source);
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function setIndex($index)
    {
        $this->setAttribute('index', $index);
    }

    public function compile(Compiler $compiler): void
    {
        $this->compileTemplate($compiler);

        foreach ($this->getAttribute('embedded_templates') as $template) {
            $compiler->subcompile($template);
        }
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileTemplate(Compiler $compiler)
    {
        if (!$this->getAttribute('index')) {
            $compiler->write('<?php');
        }

        $this->compileClassHeader($compiler);

        $this->compileConstructor($compiler);

        $this->compileGetParent($compiler);

        $this->compileDisplay($compiler);

        $compiler->subcompile($this->getNode('blocks'));

        $this->compileMacros($compiler);

        $this->compileGetTemplateName($compiler);

        $this->compileIsTraitable($compiler);

        $this->compileDebugInfo($compiler);

        $this->compileGetSourceContext($compiler);

        $this->compileClassFooter($compiler);
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileGetParent(Compiler $compiler)
    {
        if (!$this->hasNode('parent')) {
            return;
        }
        $parent = $this->getNode('parent');

        $compiler
<<<<<<< HEAD
            ->write("protected function doGetParent(array \$context): bool|string|Template|TemplateWrapper\n", "{\n")
=======
            ->write("protected function doGetParent(array \$context)\n", "{\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->indent()
            ->addDebugInfo($parent)
            ->write('return ')
        ;

        if ($parent instanceof ConstantExpression) {
            $compiler->subcompile($parent);
        } else {
            $compiler
<<<<<<< HEAD
                ->raw('$this->load(')
                ->subcompile($parent)
                ->raw(', ')
=======
                ->raw('$this->loadTemplate(')
                ->subcompile($parent)
                ->raw(', ')
                ->repr($this->getSourceContext()->getName())
                ->raw(', ')
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->repr($parent->getTemplateLine())
                ->raw(')')
            ;
        }

        $compiler
            ->raw(";\n")
            ->outdent()
            ->write("}\n\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileClassHeader(Compiler $compiler)
    {
        $compiler
            ->write("\n\n")
        ;
        if (!$this->getAttribute('index')) {
            $compiler
                ->write("use Twig\Environment;\n")
                ->write("use Twig\Error\LoaderError;\n")
                ->write("use Twig\Error\RuntimeError;\n")
<<<<<<< HEAD
                ->write("use Twig\Extension\CoreExtension;\n")
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->write("use Twig\Extension\SandboxExtension;\n")
                ->write("use Twig\Markup;\n")
                ->write("use Twig\Sandbox\SecurityError;\n")
                ->write("use Twig\Sandbox\SecurityNotAllowedTagError;\n")
                ->write("use Twig\Sandbox\SecurityNotAllowedFilterError;\n")
                ->write("use Twig\Sandbox\SecurityNotAllowedFunctionError;\n")
                ->write("use Twig\Source;\n")
<<<<<<< HEAD
                ->write("use Twig\Template;\n")
                ->write("use Twig\TemplateWrapper;\n")
                ->write("\n")
=======
                ->write("use Twig\Template;\n\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ;
        }
        $compiler
            // if the template name contains */, add a blank to avoid a PHP parse error
            ->write('/* '.str_replace('*/', '* /', $this->getSourceContext()->getName())." */\n")
            ->write('class '.$compiler->getEnvironment()->getTemplateClass($this->getSourceContext()->getName(), $this->getAttribute('index')))
            ->raw(" extends Template\n")
            ->write("{\n")
            ->indent()
<<<<<<< HEAD
            ->write("private Source \$source;\n")
            ->write("/**\n")
            ->write(" * @var array<string, Template>\n")
            ->write(" */\n")
            ->write("private array \$macros = [];\n\n")
        ;
    }

    /**
     * @return void
     */
=======
            ->write("private \$source;\n")
            ->write("private \$macros = [];\n\n")
        ;
    }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileConstructor(Compiler $compiler)
    {
        $compiler
            ->write("public function __construct(Environment \$env)\n", "{\n")
            ->indent()
            ->subcompile($this->getNode('constructor_start'))
            ->write("parent::__construct(\$env);\n\n")
            ->write("\$this->source = \$this->getSourceContext();\n\n")
        ;

        // parent
        if (!$this->hasNode('parent')) {
            $compiler->write("\$this->parent = false;\n\n");
        }

        $countTraits = \count($this->getNode('traits'));
        if ($countTraits) {
            // traits
            foreach ($this->getNode('traits') as $i => $trait) {
                $node = $trait->getNode('template');

                $compiler
                    ->addDebugInfo($node)
<<<<<<< HEAD
                    ->write(\sprintf('$_trait_%s = $this->load(', $i))
                    ->subcompile($node)
                    ->raw(', ')
                    ->repr($node->getTemplateLine())
                    ->raw(");\n")
                    ->write(\sprintf("if (!\$_trait_%s->unwrap()->isTraitable()) {\n", $i))
=======
                    ->write(sprintf('$_trait_%s = $this->loadTemplate(', $i))
                    ->subcompile($node)
                    ->raw(', ')
                    ->repr($node->getTemplateName())
                    ->raw(', ')
                    ->repr($node->getTemplateLine())
                    ->raw(");\n")
                    ->write(sprintf("if (!\$_trait_%s->isTraitable()) {\n", $i))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    ->indent()
                    ->write("throw new RuntimeError('Template \"'.")
                    ->subcompile($trait->getNode('template'))
                    ->raw(".'\" cannot be used as a trait.', ")
                    ->repr($node->getTemplateLine())
                    ->raw(", \$this->source);\n")
                    ->outdent()
                    ->write("}\n")
<<<<<<< HEAD
                    ->write(\sprintf("\$_trait_%s_blocks = \$_trait_%s->unwrap()->getBlocks();\n\n", $i, $i))
=======
                    ->write(sprintf("\$_trait_%s_blocks = \$_trait_%s->getBlocks();\n\n", $i, $i))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ;

                foreach ($trait->getNode('targets') as $key => $value) {
                    $compiler
<<<<<<< HEAD
                        ->write(\sprintf('if (!isset($_trait_%s_blocks[', $i))
=======
                        ->write(sprintf('if (!isset($_trait_%s_blocks[', $i))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                        ->string($key)
                        ->raw("])) {\n")
                        ->indent()
                        ->write("throw new RuntimeError('Block ")
                        ->string($key)
                        ->raw(' is not defined in trait ')
                        ->subcompile($trait->getNode('template'))
                        ->raw(".', ")
                        ->repr($node->getTemplateLine())
                        ->raw(", \$this->source);\n")
                        ->outdent()
                        ->write("}\n\n")

<<<<<<< HEAD
                        ->write(\sprintf('$_trait_%s_blocks[', $i))
                        ->subcompile($value)
                        ->raw(\sprintf('] = $_trait_%s_blocks[', $i))
                        ->string($key)
                        ->raw(\sprintf(']; unset($_trait_%s_blocks[', $i))
                        ->string($key)
                        ->raw(']); $this->traitAliases[')
                        ->subcompile($value)
                        ->raw('] = ')
                        ->string($key)
                        ->raw(";\n\n")
=======
                        ->write(sprintf('$_trait_%s_blocks[', $i))
                        ->subcompile($value)
                        ->raw(sprintf('] = $_trait_%s_blocks[', $i))
                        ->string($key)
                        ->raw(sprintf(']; unset($_trait_%s_blocks[', $i))
                        ->string($key)
                        ->raw("]);\n\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    ;
                }
            }

            if ($countTraits > 1) {
                $compiler
                    ->write("\$this->traits = array_merge(\n")
                    ->indent()
                ;

                for ($i = 0; $i < $countTraits; ++$i) {
                    $compiler
<<<<<<< HEAD
                        ->write(\sprintf('$_trait_%s_blocks'.($i == $countTraits - 1 ? '' : ',')."\n", $i))
=======
                        ->write(sprintf('$_trait_%s_blocks'.($i == $countTraits - 1 ? '' : ',')."\n", $i))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    ;
                }

                $compiler
                    ->outdent()
                    ->write(");\n\n")
                ;
            } else {
                $compiler
                    ->write("\$this->traits = \$_trait_0_blocks;\n\n")
                ;
            }

            $compiler
                ->write("\$this->blocks = array_merge(\n")
                ->indent()
                ->write("\$this->traits,\n")
                ->write("[\n")
            ;
        } else {
            $compiler
                ->write("\$this->blocks = [\n")
            ;
        }

        // blocks
        $compiler
            ->indent()
        ;

        foreach ($this->getNode('blocks') as $name => $node) {
            $compiler
<<<<<<< HEAD
                ->write(\sprintf("'%s' => [\$this, 'block_%s'],\n", $name, $name))
=======
                ->write(sprintf("'%s' => [\$this, 'block_%s'],\n", $name, $name))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ;
        }

        if ($countTraits) {
            $compiler
                ->outdent()
                ->write("]\n")
                ->outdent()
                ->write(");\n")
            ;
        } else {
            $compiler
                ->outdent()
                ->write("];\n")
            ;
        }

        $compiler
            ->subcompile($this->getNode('constructor_end'))
            ->outdent()
            ->write("}\n\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
    protected function compileDisplay(Compiler $compiler)
    {
        $compiler
            ->write("protected function doDisplay(array \$context, array \$blocks = []): iterable\n", "{\n")
=======
    protected function compileDisplay(Compiler $compiler)
    {
        $compiler
            ->write("protected function doDisplay(array \$context, array \$blocks = [])\n", "{\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->indent()
            ->write("\$macros = \$this->macros;\n")
            ->subcompile($this->getNode('display_start'))
            ->subcompile($this->getNode('body'))
        ;

        if ($this->hasNode('parent')) {
            $parent = $this->getNode('parent');

            $compiler->addDebugInfo($parent);
            if ($parent instanceof ConstantExpression) {
                $compiler
<<<<<<< HEAD
                    ->write('$this->parent = $this->load(')
                    ->subcompile($parent)
                    ->raw(', ')
                    ->repr($parent->getTemplateLine())
                    ->raw(");\n")
                ;
            }
            $compiler->write('yield from ');

            if ($parent instanceof ConstantExpression) {
                $compiler->raw('$this->parent');
            } else {
                $compiler->raw('$this->getParent($context)');
            }
            $compiler->raw("->unwrap()->yield(\$context, array_merge(\$this->blocks, \$blocks));\n");
        }

        $compiler->subcompile($this->getNode('display_end'));

        if (!$this->hasNode('parent')) {
            $compiler->write("yield from [];\n");
        }

        $compiler
=======
                    ->write('$this->parent = $this->loadTemplate(')
                    ->subcompile($parent)
                    ->raw(', ')
                    ->repr($this->getSourceContext()->getName())
                    ->raw(', ')
                    ->repr($parent->getTemplateLine())
                    ->raw(");\n")
                ;
                $compiler->write('$this->parent');
            } else {
                $compiler->write('$this->getParent($context)');
            }
            $compiler->raw("->display(\$context, array_merge(\$this->blocks, \$blocks));\n");
        }

        $compiler
            ->subcompile($this->getNode('display_end'))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->outdent()
            ->write("}\n\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileClassFooter(Compiler $compiler)
    {
        $compiler
            ->subcompile($this->getNode('class_end'))
            ->outdent()
            ->write("}\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileMacros(Compiler $compiler)
    {
        $compiler->subcompile($this->getNode('macros'));
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileGetTemplateName(Compiler $compiler)
    {
        $compiler
            ->write("/**\n")
            ->write(" * @codeCoverageIgnore\n")
            ->write(" */\n")
<<<<<<< HEAD
            ->write("public function getTemplateName(): string\n", "{\n")
=======
            ->write("public function getTemplateName()\n", "{\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->indent()
            ->write('return ')
            ->repr($this->getSourceContext()->getName())
            ->raw(";\n")
            ->outdent()
            ->write("}\n\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileIsTraitable(Compiler $compiler)
    {
        // A template can be used as a trait if:
        //   * it has no parent
        //   * it has no macros
        //   * it has no body
        //
        // Put another way, a template can be used as a trait if it
        // only contains blocks and use statements.
        $traitable = !$this->hasNode('parent') && 0 === \count($this->getNode('macros'));
        if ($traitable) {
            if ($this->getNode('body') instanceof BodyNode) {
<<<<<<< HEAD
                $nodes = $this->getNode('body')->getNode('0');
=======
                $nodes = $this->getNode('body')->getNode(0);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            } else {
                $nodes = $this->getNode('body');
            }

            if (!\count($nodes)) {
<<<<<<< HEAD
                $nodes = new Nodes([$nodes]);
=======
                $nodes = new Node([$nodes]);
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }

            foreach ($nodes as $node) {
                if (!\count($node)) {
                    continue;
                }

<<<<<<< HEAD
=======
                if ($node instanceof TextNode && ctype_space($node->getAttribute('data'))) {
                    continue;
                }

                if ($node instanceof BlockReferenceNode) {
                    continue;
                }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                $traitable = false;
                break;
            }
        }

        if ($traitable) {
            return;
        }

        $compiler
            ->write("/**\n")
            ->write(" * @codeCoverageIgnore\n")
            ->write(" */\n")
<<<<<<< HEAD
            ->write("public function isTraitable(): bool\n", "{\n")
            ->indent()
            ->write("return false;\n")
=======
            ->write("public function isTraitable()\n", "{\n")
            ->indent()
            ->write(sprintf("return %s;\n", $traitable ? 'true' : 'false'))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->outdent()
            ->write("}\n\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    protected function compileDebugInfo(Compiler $compiler)
    {
        $compiler
            ->write("/**\n")
            ->write(" * @codeCoverageIgnore\n")
            ->write(" */\n")
<<<<<<< HEAD
            ->write("public function getDebugInfo(): array\n", "{\n")
            ->indent()
            ->write(\sprintf("return %s;\n", str_replace("\n", '', var_export(array_reverse($compiler->getDebugInfo(), true), true))))
=======
            ->write("public function getDebugInfo()\n", "{\n")
            ->indent()
            ->write(sprintf("return %s;\n", str_replace("\n", '', var_export(array_reverse($compiler->getDebugInfo(), true), true))))
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->outdent()
            ->write("}\n\n")
        ;
    }

<<<<<<< HEAD
    /**
     * @return void
     */
    protected function compileGetSourceContext(Compiler $compiler)
    {
        $compiler
            ->write("public function getSourceContext(): Source\n", "{\n")
=======
    protected function compileGetSourceContext(Compiler $compiler)
    {
        $compiler
            ->write("public function getSourceContext()\n", "{\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->indent()
            ->write('return new Source(')
            ->string($compiler->getEnvironment()->isDebug() ? $this->getSourceContext()->getCode() : '')
            ->raw(', ')
            ->string($this->getSourceContext()->getName())
            ->raw(', ')
            ->string($this->getSourceContext()->getPath())
            ->raw(");\n")
            ->outdent()
            ->write("}\n")
        ;
    }
<<<<<<< HEAD
=======

    protected function compileLoadTemplate(Compiler $compiler, $node, $var)
    {
        if ($node instanceof ConstantExpression) {
            $compiler
                ->write(sprintf('%s = $this->loadTemplate(', $var))
                ->subcompile($node)
                ->raw(', ')
                ->repr($node->getTemplateName())
                ->raw(', ')
                ->repr($node->getTemplateLine())
                ->raw(");\n")
            ;
        } else {
            throw new \LogicException('Trait templates can only be constant nodes.');
        }
    }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
