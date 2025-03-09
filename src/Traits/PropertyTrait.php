<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Attributes\Property;
use ReflectionProperty;

trait PropertyTrait
{
	/**
	 * @param ReflectionProperty $classProperty
	 * @param Property $property
	 * @return string
	 */
	protected function getName(ReflectionProperty $classProperty, Property $property): string
	{
		if ($property->getName() !== null) {
			return $property->getName();
		}

		return $classProperty->getName();
	}

	/**
	 * @param ReflectionProperty $classProperty
	 * @param Property $property
	 * @return string
	 */
	protected function getGetter(ReflectionProperty $classProperty, Property $property): string
	{
		if ($property->getGetter() !== null) {
			return $property->getGetter();
		}

		return 'get' . ucfirst($classProperty->getName());
	}

	/**
	 * @param ReflectionProperty $classProperty
	 * @param Property $property
	 * @return string
	 */
	protected function getSetter(ReflectionProperty $classProperty, Property $property): string
	{
		if ($property->getSetter() !== null) {
			return $property->getSetter();
		}

		return 'set' . ucfirst($classProperty->getName());
	}
}
