<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Exceptions;

use Exception;

final class ValidationException extends Exception
{
	public function __construct(protected $message, private readonly string $propertyName, private readonly string $validationName)
	{
		parent::__construct($message);
	}

	public function getPropertyName(): string
	{
		return $this->propertyName;
	}

	public function getValidationName(): string
	{
		return $this->validationName;
	}
}
