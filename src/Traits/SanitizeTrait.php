<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Interfaces\SanitizationInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

trait SanitizeTrait
{
	/**
	 * @throws ReflectionException
	 */
	protected function sanitize(ReflectionProperty $property, mixed &$value): void
	{
		$attributes = $property->getAttributes();

		foreach ($attributes as $attribute) {
			$attributeInstance = $attribute->newInstance();
			$attributeReflection = new ReflectionClass($attributeInstance);

			if (!$attributeReflection->implementsInterface(SanitizationInterface::class)) {
				continue;
			}

			$attributeInstance->sanitize($value);
		}
	}
}
