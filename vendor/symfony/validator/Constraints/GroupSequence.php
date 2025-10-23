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
use Symfony\Component\Validator\Attribute\HasNamedArguments;

=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
/**
 * A sequence of validation groups.
 *
 * When validating a group sequence, each group will only be validated if all
 * of the previous groups in the sequence succeeded. For example:
 *
 *     $validator->validate($address, null, new GroupSequence(['Basic', 'Strict']));
 *
 * In the first step, all constraints that belong to the group "Basic" will be
 * validated. If none of the constraints fail, the validator will then validate
 * the constraints in group "Strict". This is useful, for example, if "Strict"
 * contains expensive checks that require a lot of CPU or slow, external
 * services. You usually don't want to run expensive checks if any of the cheap
 * checks fail.
 *
 * When adding metadata to a class, you can override the "Default" group of
 * that class with a group sequence:
 *     #[GroupSequence(['Address', 'Strict'])]
 *     class Address
 *     {
 *         // ...
 *     }
 *
 * Whenever you validate that object in the "Default" group, the group sequence
 * will be validated:
 *
 *     $validator->validate($address);
 *
 * If you want to execute the constraints of the "Default" group for a class
 * with an overridden default group, pass the class name as group name instead:
 *
 *     $validator->validate($address, null, "Address")
 *
<<<<<<< HEAD
=======
 * @Annotation
 * @Target({"CLASS", "ANNOTATION"})
 *
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class GroupSequence
{
    /**
     * The groups in the sequence.
     *
     * @var array<int, string|string[]|GroupSequence>
     */
<<<<<<< HEAD
    public array $groups;
=======
    public $groups;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * The group in which cascaded objects are validated when validating
     * this sequence.
     *
     * By default, cascaded objects are validated in each of the groups of
     * the sequence.
     *
     * If a class has a group sequence attached, that sequence replaces the
     * "Default" group. When validating that class in the "Default" group, the
     * group sequence is used instead, but still the "Default" group should be
     * cascaded to other objects.
<<<<<<< HEAD
     */
    public string|GroupSequence $cascadedGroup;
=======
     *
     * @var string|GroupSequence
     */
    public $cascadedGroup;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c

    /**
     * Creates a new group sequence.
     *
     * @param array<string|string[]|GroupSequence> $groups The groups in the sequence
     */
<<<<<<< HEAD
    #[HasNamedArguments]
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    public function __construct(array $groups)
    {
        $this->groups = $groups['value'] ?? $groups;
    }
}
