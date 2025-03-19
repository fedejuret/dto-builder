<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Exceptions\RepeatedAttributeException;
use ReflectionClass;
use ReflectionException;

trait Loadable
{
	use PropertyTrait, ValidationsTrait;

	/**
	 * @param array $array
	 * @return self
	 * @throws ReflectionException
	 * @throws RepeatedAttributeException
	 */
	public function loadFromArray(array $array): self
	{
		$props = (new ReflectionClass(static::class))->getProperties();

		foreach ($props as $prop) {
			$attributes = $prop->getAttributes(Property::class);

			if (count($attributes) === 0) {
				continue;
			}

			if ($attributes[0]->isRepeated()) {
				throw new RepeatedAttributeException(sprintf(
					'attribute %s was repeated in property %s',
					Property::class,
					$prop->getName()
				));
			}

			foreach ($attributes as $attribute) {
				$property = $attribute->newInstance();
				$indexName = $this->getPropertyName($prop, $property);

				$value = $array[$indexName] ?? null;

				$this->validate($prop, $value);

				$setter = $this->getSetter($prop, $property);
				if (method_exists($this, $setter)) {
					$this->$setter($value);
				} else {
					$prop->setValue($this, $value);
				}
			}
		}

		return $this;
	}
}
