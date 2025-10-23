<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Exception;

class MissingOptionsException extends ValidatorException
{
<<<<<<< HEAD
    public function __construct(
        string $message,
        private array $options,
    ) {
        parent::__construct($message);
    }

    public function getOptions(): array
=======
    private array $options;

    public function __construct(string $message, array $options)
    {
        parent::__construct($message);

        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
    {
        return $this->options;
    }
}
