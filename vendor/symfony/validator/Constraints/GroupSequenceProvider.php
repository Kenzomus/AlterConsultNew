<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

<<<<<<< HEAD
=======
use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use Symfony\Component\Validator\Attribute\HasNamedArguments;

/**
 * Attribute to define a group sequence provider.
 *
<<<<<<< HEAD
=======
 * @Annotation
 * @NamedArgumentConstructor
 * @Target({"CLASS", "ANNOTATION"})
 *
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class GroupSequenceProvider
{
    #[HasNamedArguments]
    public function __construct(public ?string $provider = null)
    {
    }
}
