<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

trait ValidationsTrait
{
	/**
	 * @param ReflectionProperty $property
	 * @param mixed $value
	 * @return void
	 * @throws ReflectionException
	 */
	protected function validate(ReflectionProperty $property, mixed $value): void
	{
		$attributes = $property->getAttributes();

		foreach ($attributes as $attribute) {
			$attributeInstance = $attribute->newInstance();
			$attributeReflection = new ReflectionClass($attributeInstance);

			if (!$attributeReflection->implementsInterface(ValidationInterface::class)) {
				continue;
			}

			$attributeInstance->validate($property, $value);
		}
	}
}
