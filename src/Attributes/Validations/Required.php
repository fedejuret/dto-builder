<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Required implements ValidationInterface
{
	public function __construct(
		private ?string $failMessage = null,
	) {}

	/**
	 * @param ReflectionProperty $property
	 * @param mixed $value
	 * @return void
	 * @throws ValidationException
	 */
	public function validate(ReflectionProperty $property, mixed $value): void
	{
		if ($value === null) {
			if ($this->failMessage === null) {
				$this->failMessage = sprintf('"%s" is required.', $property->getName());
			}

			throw new ValidationException($this->failMessage, $property->getName(), self::class);
		}
	}
}
