<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Validations;

use Attribute;
use DateTimeImmutable;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Interfaces\ValidationInterface;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class IsDate implements ValidationInterface
{
	public function __construct(
		private readonly string $format = 'Y-m-d',
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
		$date = DateTimeImmutable::createFromFormat($this->format, $value);

		if ($date === false || $date->format($this->format) !== $value) {
			if ($this->failMessage === null) {
				$this->failMessage = sprintf('"%s" must be a valid date in the format %s', $property->getName(), $this->format);
			}

			throw new ValidationException($this->failMessage, $property->getName(), self::class);
		}
	}
}
