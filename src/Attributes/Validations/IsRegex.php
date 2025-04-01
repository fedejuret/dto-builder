<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class IsRegex implements ValidationInterface
{
	public function __construct(
		private readonly string $pattern,
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
		if (preg_match($this->pattern, $value) !== 1) {
			if ($this->failMessage === null) {
				$this->failMessage = sprintf('Value %s does not match with pattern [%s]', $value, $this->pattern);
			}

			throw new ValidationException($this->failMessage, $property->getName(), self::class);
		}
	}
}
