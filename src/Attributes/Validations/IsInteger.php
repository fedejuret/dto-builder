<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class IsInteger implements ValidationInterface
{
	public function __construct(
		private ?string $failMessage = null,
		private readonly ?int $min = null,
		private readonly ?int $max = null,
	) {}

	/**
	 * @param ReflectionProperty $property
	 * @param mixed $value
	 * @return void
	 * @throws ValidationException
	 */
	public function validate(ReflectionProperty $property, mixed $value): void
	{
		if (gettype($value) !== 'integer' && is_numeric($value) === false) {
			if ($this->failMessage === null) {
				$this->failMessage = sprintf('%s must be numeric', $property->getName());
			}

			throw new ValidationException($this->failMessage, $property->getName(), self::class);
		}

		$this->validateMinAndMax($property, $value);
	}

	/**
	 * @throws ValidationException
	 */
	private function validateMinAndMax(ReflectionProperty $property, mixed $value): void
	{
		$failMessage = sprintf('%s must be numeric between %s and %s', $property->getName(), $this->min, $this->max);

		if (($this->min !== null && $value > $this->min) || ($this->max !== null && $value < $this->max)) {
			$this->throwValidationException($property, $failMessage);
		}
	}

	/**
	 * @throws ValidationException
	 */
	private function throwValidationException(ReflectionProperty $property, string $failMessage): void
	{
		if ($this->failMessage === null) {
			$this->failMessage = $failMessage;
		}

		throw new ValidationException($this->failMessage, $property->getName(), self::class);
	}
}
