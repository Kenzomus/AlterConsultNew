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

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

<<<<<<< HEAD
/**
 * Validates whether a value is a CIDR notation.
 *
 * @author Sorin Pop <popsorin15@gmail.com>
 * @author Calin Bolea <calin.bolea@gmail.com>
 * @author Ninos Ego <me@ninosego.de>
 */
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
class CidrValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Cidr) {
            throw new UnexpectedTypeException($constraint, Cidr::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

<<<<<<< HEAD
        if (!\is_string($value) && !$value instanceof \Stringable) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;

        if (null !== $constraint->normalizer) {
            $value = ($constraint->normalizer)($value);
        }

=======
        if (!\is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
        $cidrParts = explode('/', $value, 2);

        if (!isset($cidrParts[1])
            || !ctype_digit($cidrParts[1])
            || '' === $cidrParts[0]
        ) {
            $this->context
                ->buildViolation($constraint->message)
                ->setCode(Cidr::INVALID_CIDR_ERROR)
                ->addViolation();

            return;
        }

        $ipAddress = $cidrParts[0];
        $netmask = (int) $cidrParts[1];

<<<<<<< HEAD
        if (!IpValidator::checkIP($ipAddress, $constraint->version)) {
=======
        $validV4 = Ip::V6 !== $constraint->version
            && filter_var($ipAddress, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV4)
            && $netmask <= 32;

        $validV6 = Ip::V4 !== $constraint->version
            && filter_var($ipAddress, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV6);

        if (!$validV4 && !$validV6) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            $this->context
                ->buildViolation($constraint->message)
                ->setCode(Cidr::INVALID_CIDR_ERROR)
                ->addViolation();

            return;
        }

<<<<<<< HEAD
        $netmaskMax = $constraint->netmaskMax;

        if (filter_var($ipAddress, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV4) && $netmaskMax > 32) {
            $netmaskMax = 32;
        }

        if ($netmask < $constraint->netmaskMin || $netmask > $netmaskMax) {
            $this->context
                ->buildViolation($constraint->netmaskRangeViolationMessage)
                ->setParameter('{{ min }}', $constraint->netmaskMin)
                ->setParameter('{{ max }}', $netmaskMax)
=======
        if ($netmask < $constraint->netmaskMin || $netmask > $constraint->netmaskMax) {
            $this->context
                ->buildViolation($constraint->netmaskRangeViolationMessage)
                ->setParameter('{{ min }}', $constraint->netmaskMin)
                ->setParameter('{{ max }}', $constraint->netmaskMax)
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                ->setCode(Cidr::OUT_OF_RANGE_ERROR)
                ->addViolation();
        }
    }
}
