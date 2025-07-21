<?php

declare(strict_types=1);

namespace Fedejuret\DtoBuilder\Interfaces;

interface SanitizationInterface
{
	public function sanitize(mixed &$value): void;
}
