<?php

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class IPAddress implements ValidationInterface
{

    public function __construct(
        private ?string $failMessage = null,
    ) {
    }

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @return void
     * @throws ValidationException
     */
    public function validate(ReflectionProperty $property, mixed $value): void
    {

        if (filter_var($value, FILTER_VALIDATE_IP) === false) {

            if ($this->failMessage === null) {
                $this->failMessage = sprintf('"%s" must be a valid ip address', $property->getName());
            }

            throw new ValidationException($this->failMessage);
        }
    }
}