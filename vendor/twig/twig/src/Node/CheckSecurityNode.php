<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
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

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
<<<<<<< HEAD
#[YieldReady]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
class CheckSecurityNode extends Node
{
    private $usedFilters;
    private $usedTags;
    private $usedFunctions;

<<<<<<< HEAD
    /**
     * @param array<string, int> $usedFilters
     * @param array<string, int> $usedTags
     * @param array<string, int> $usedFunctions
     */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(array $usedFilters, array $usedTags, array $usedFunctions)
    {
        $this->usedFilters = $usedFilters;
        $this->usedTags = $usedTags;
        $this->usedFunctions = $usedFunctions;

        parent::__construct();
    }

    public function compile(Compiler $compiler): void
    {
<<<<<<< HEAD
=======
        $tags = $filters = $functions = [];
        foreach (['tags', 'filters', 'functions'] as $type) {
            foreach ($this->{'used'.ucfirst($type)} as $name => $node) {
                if ($node instanceof Node) {
                    ${$type}[$name] = $node->getTemplateLine();
                } else {
                    ${$type}[$node] = null;
                }
            }
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $compiler
            ->write("\n")
            ->write("public function checkSecurity()\n")
            ->write("{\n")
            ->indent()
<<<<<<< HEAD
            ->write('static $tags = ')->repr(array_filter($this->usedTags))->raw(";\n")
            ->write('static $filters = ')->repr(array_filter($this->usedFilters))->raw(";\n")
            ->write('static $functions = ')->repr(array_filter($this->usedFunctions))->raw(";\n\n")
=======
            ->write('static $tags = ')->repr(array_filter($tags))->raw(";\n")
            ->write('static $filters = ')->repr(array_filter($filters))->raw(";\n")
            ->write('static $functions = ')->repr(array_filter($functions))->raw(";\n\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->write("try {\n")
            ->indent()
            ->write("\$this->sandbox->checkSecurity(\n")
            ->indent()
<<<<<<< HEAD
            ->write(!$this->usedTags ? "[],\n" : "['".implode("', '", array_keys($this->usedTags))."'],\n")
            ->write(!$this->usedFilters ? "[],\n" : "['".implode("', '", array_keys($this->usedFilters))."'],\n")
            ->write(!$this->usedFunctions ? "[],\n" : "['".implode("', '", array_keys($this->usedFunctions))."'],\n")
            ->write("\$this->source\n")
=======
            ->write(!$tags ? "[],\n" : "['".implode("', '", array_keys($tags))."'],\n")
            ->write(!$filters ? "[],\n" : "['".implode("', '", array_keys($filters))."'],\n")
            ->write(!$functions ? "[]\n" : "['".implode("', '", array_keys($functions))."']\n")
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            ->outdent()
            ->write(");\n")
            ->outdent()
            ->write("} catch (SecurityError \$e) {\n")
            ->indent()
            ->write("\$e->setSourceContext(\$this->source);\n\n")
            ->write("if (\$e instanceof SecurityNotAllowedTagError && isset(\$tags[\$e->getTagName()])) {\n")
            ->indent()
            ->write("\$e->setTemplateLine(\$tags[\$e->getTagName()]);\n")
            ->outdent()
            ->write("} elseif (\$e instanceof SecurityNotAllowedFilterError && isset(\$filters[\$e->getFilterName()])) {\n")
            ->indent()
            ->write("\$e->setTemplateLine(\$filters[\$e->getFilterName()]);\n")
            ->outdent()
            ->write("} elseif (\$e instanceof SecurityNotAllowedFunctionError && isset(\$functions[\$e->getFunctionName()])) {\n")
            ->indent()
            ->write("\$e->setTemplateLine(\$functions[\$e->getFunctionName()]);\n")
            ->outdent()
            ->write("}\n\n")
            ->write("throw \$e;\n")
            ->outdent()
            ->write("}\n\n")
            ->outdent()
            ->write("}\n")
        ;
    }
}
