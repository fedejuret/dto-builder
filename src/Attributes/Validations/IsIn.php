<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class IsIn implements ValidationInterface
{
	public function __construct(
		private readonly array|\Enum $availableValues,
		private readonly bool $strict = false,
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
		if (!in_array($value, $this->availableValues, $this->strict)) {
			if ($this->failMessage === null) {
				$this->failMessage = sprintf('"%s" must be array', $property->getName());
			}

			throw new ValidationException($this->failMessage, $property->getName(), self::class);
		}
	}
}
