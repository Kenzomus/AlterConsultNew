<?php declare(strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Diff;

<<<<<<< HEAD
=======
use function get_class;
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use function gettype;
use function is_object;
use function sprintf;
use Exception;

final class ConfigurationException extends InvalidArgumentException
{
    public function __construct(
        string $option,
        string $expected,
        $value,
        int $code = 0,
        ?Exception $previous = null
    ) {
        parent::__construct(
            sprintf(
                'Option "%s" must be %s, got "%s".',
                $option,
                $expected,
<<<<<<< HEAD
                is_object($value) ? $value::class : (null === $value ? '<null>' : gettype($value) . '#' . $value),
            ),
            $code,
            $previous,
=======
                is_object($value) ? get_class($value) : (null === $value ? '<null>' : gettype($value) . '#' . $value)
            ),
            $code,
            $previous
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        );
    }
}
