<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class IsBoolean implements ValidationInterface
{
	public function __construct(
		private ?string $failMessage = null,
	) {}

	/**
	 * @param ReflectionProperty $property
	 * @param mixed $value
	 * @throws ValidationException
	 * @return void
	 */
	public function validate(ReflectionProperty $property, mixed $value): void
	{
		if (gettype($value) !== 'boolean') {
			if ($this->failMessage === null) {
				$this->failMessage = sprintf('"%s" must be boolean', $property->getName());
			}

			throw new ValidationException($this->failMessage, $property->getName(), self::class);
		}
	}
}
