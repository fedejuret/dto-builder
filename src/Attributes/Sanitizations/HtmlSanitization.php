<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Sanitizations;

use Attribute;
use Fedejuret\DtoBuilder\Interfaces\SanitizationInterface;

#[Attribute(Attribute::TARGET_PROPERTY)]
final readonly class HtmlSanitization implements SanitizationInterface
{
	/**
	 * @param string|null $keepTags HTML tags will be conserved
	 */
	public function __construct(
		private ?string $keepTags = null
	) {}

	/**
	 * @param mixed $value
	 * @return void
	 */
	public function sanitize(mixed &$value): void
	{
		if (!is_string($value)) {
			return;
		}

		$value = strip_tags($value, $this->keepTags);
	}
}
