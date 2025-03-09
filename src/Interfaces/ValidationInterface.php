<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Interfaces;

use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use ReflectionProperty;

interface ValidationInterface
{
	/**
	 * @param ReflectionProperty $property
	 * @param mixed $value
	 * @throws ValidationException
	 * @return void
	 */
	public function validate(ReflectionProperty $property, mixed $value): void;
}
