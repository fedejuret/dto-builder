<?php

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Attributes\Property;

trait PropertyTrait
{

    /**
     * @param \ReflectionProperty $classProperty
     * @param Property $property
     * @return string
     */
    protected function getName(\ReflectionProperty $classProperty, Property $property): string
    {

        if ($property->getName() !== null) {
            return $property->getName();
        }

        return $classProperty->getName();
    }

    /**
     * @param Property $property
     * @return bool
     */
    protected function isRequired(Property $property): bool
    {
        return $property->isRequired();
    }

    protected function getGetter(\ReflectionProperty $classProperty, Property $property): string {
        if ($property->getGetter() !== null) {
            return $property->getGetter();
        }

        return 'get' . ucfirst($classProperty->getName());
    }

    protected function getSetter(\ReflectionProperty $classProperty, Property $property): string {
        if ($property->getSetter() !== null) {
            return $property->getSetter();
        }

        return 'set' . ucfirst($classProperty->getName());
    }
}