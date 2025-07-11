<?php

declare(strict_types=1);

use Fedejuret\DtoBuilder\Traits\Loadable;

describe('1.2 test strings validations', function () {
	test('1.2.0 test that library can validate text length', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\Required]
			#[Fedejuret\DtoBuilder\Attributes\Validations\Length(min: 8, max: 40)]
			public string $description;
		};

		$instance = $class->loadFromArray([
			'description' => 'some text rather than 8 characters',
		]);

		expect($instance->description)->toBe('some text rather than 8 characters');
	});

	test('1.2.1 test that library can validate text length when is less than required', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\Length(min: 8, max: 40)]
			public string $description;
		};

		$class->loadFromArray([
			'description' => 'some',
		]);
	})->throws(Fedejuret\DtoBuilder\Exceptions\ValidationException::class);

	test('1.2.2 test that library can validate text length when is rather than required', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\Length(min: 1, max: 4)]
			public string $description;
		};

		$class->loadFromArray([
			'description' => 'required',
		]);
	})->throws(Fedejuret\DtoBuilder\Exceptions\ValidationException::class);

	test('1.2.3 test that library can validate uuid', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsUuid]
			public string $uuid;
		};

		$dto = $class->loadFromArray([
			'uuid' => '5f97db4a-7dfb-40c1-95e0-0c5a7fa8aae8',
		]);

		expect($dto->uuid)->toBe('5f97db4a-7dfb-40c1-95e0-0c5a7fa8aae8');
	});

	test('1.2.4 test that library can validate and throw exception', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsUuid]
			public string $uuid;
		};

		$dto = $class->loadFromArray([
			'uuid' => '5f97db4a-7dfb-40c1-95e0-0c5a7fa8aae',
		]);
	})->throws(Fedejuret\DtoBuilder\Exceptions\ValidationException::class);

	test('1.2.5 test that library can validate regex pattern', function () {
		$class = new class() {
			use Loadable;

			#[Fedejuret\DtoBuilder\Attributes\Property]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsRegex(pattern: '/^[a-z_]+$/')]
			public string $code;
		};

		$dto = $class->loadFromArray([
			'code' => 'some_valid_code',
		]);

		expect($dto->code)->toBe('some_valid_code');

		$class->loadFromArray([
			'code' => 'some_-invalid-123-valid_code',
		]);
	})->throws(Fedejuret\DtoBuilder\Exceptions\ValidationException::class);
});
