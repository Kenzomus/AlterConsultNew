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
use Twig\TemplateWrapper;
=======
namespace Twig\Extension {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Twig\TwigFunction;

final class StringLoaderExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
<<<<<<< HEAD
            new TwigFunction('template_from_string', [self::class, 'templateFromString'], ['needs_environment' => true]),
        ];
    }

    /**
     * Loads a template from a string.
     *
     *     {{ include(template_from_string("Hello {{ name }}")) }}
     *
     * @param string|null $name An optional name of the template to be used in error messages
     *
     * @internal
     */
    public static function templateFromString(Environment $env, string|\Stringable $template, ?string $name = null): TemplateWrapper
    {
        return $env->createTemplate((string) $template, $name);
    }
=======
            new TwigFunction('template_from_string', 'twig_template_from_string', ['needs_environment' => true]),
        ];
    }
}
}

namespace {
use Twig\Environment;
use Twig\TemplateWrapper;

/**
 * Loads a template from a string.
 *
 *     {{ include(template_from_string("Hello {{ name }}")) }}
 *
 * @param string $template A template as a string or object implementing __toString()
 * @param string $name     An optional name of the template to be used in error messages
 */
function twig_template_from_string(Environment $env, $template, string $name = null): TemplateWrapper
{
    return $env->createTemplate((string) $template, $name);
}
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
}
