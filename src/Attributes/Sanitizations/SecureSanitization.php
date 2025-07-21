<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Attributes\Sanitizations;

use Attribute;
use Fedejuret\DtoBuilder\Interfaces\SanitizationInterface;

/**
 * Class SecureSanitization
 *
 * Sanitizes input data to defend against common web vulnerabilities, including several from the OWASP Top 10.
 * This attribute can be applied to DTO properties to clean potentially unsafe user input at the point of hydration.
 *
 * Features:
 * - Strips unwanted HTML tags (configurable via `$keepTags`)
 * - Escapes HTML entities to prevent XSS attacks (unless `$keepTags` is used)
 * - Removes invisible/control characters
 * - Normalizes whitespace
 *
 * Usage:
 * ```php
 * #[SecureSanitization]
 * public string $comment;
 *
 * #[SecureSanitization('<b><i>')]
 * public string $description;
 * ```
 *
 * @package Fedejuret\DtoBuilder\Attributes\Sanitizations
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final readonly class SecureSanitization implements SanitizationInterface
{
	/**
	 * @param string|null $keepTags HTML tags that are safe to keep (e.g., "<b><i><a>")
	 */
	public function __construct(
		private ?string $keepTags = null
	) {}

	/**
	 * Sanitizes input to prevent common OWASP Top 10 issues.
	 *
	 * @param mixed $value
	 * @return void
	 */
	public function sanitize(mixed &$value): void
	{
		if (!is_string($value)) {
			return;
		}

		// Remove invisible characters
		$value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value);

		$value = strip_tags($value, $this->keepTags);

		if ($this->keepTags === null) {
			// Encode special entities (prevents HTML/XSS injections)
			$value = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
		}

		// Removes multiple spaces, tabs, and unnecessary line breaks
		$value = preg_replace('/\s+/', ' ', $value);

		$value = trim($value);
	}
}
