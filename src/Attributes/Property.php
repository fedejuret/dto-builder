<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final readonly class Property
{
	/**
	 * @param string|null $name
	 * @param string|null $setter
	 * @param string|null $getter
	 */
	public function __construct(
		private ?string $name = null,
		private ?string $setter = null,
		private ?string $getter = null,
	) {}

	public function getGetter(): ?string
	{
		return $this->getter;
	}

	public function getSetter(): ?string
	{
		return $this->setter;
	}

	public function getName(): ?string
	{
		return $this->name;
	}
}
