<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Length implements ValidationInterface
{
	public function __construct(
		private readonly int $min,
		private readonly int $max,
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
		if (gettype($value) === 'string') {
			$len = strlen($value);
			if ($len < $this->min || $len > $this->max) {
				if ($this->failMessage === null) {
					$this->failMessage = sprintf(
						'Length for "%s" must between %s and %s. Given %s',
						$property->getName(),
						$this->min,
						$this->max,
						$len
					);
				}

				throw new ValidationException($this->failMessage, $property->getName(), self::class);
			}
		}
	}
}
