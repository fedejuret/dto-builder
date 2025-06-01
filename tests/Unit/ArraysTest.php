<?php

declare(strict_types=1);

use Fedejuret\DtoBuilder\Traits\Loadable;

describe('1.3 test in array validations', function () {
	test('1.3.0 test that library can validate isIn successfully and throws exception', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsIn(['sent', 'draft', 'completed'])]
			public string $status;
		};

		$instance = $class->loadFromArray([
			'status' => 'sent',
		]);

		expect($instance->status)->toBe('sent');

		$class->loadFromArray([
			'status' => 'someOtherStatus',
		]);
	})->throws(Fedejuret\DtoBuilder\Exceptions\ValidationException::class);
});
