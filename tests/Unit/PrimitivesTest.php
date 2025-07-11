<?php

declare(strict_types=1);

use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Attributes\Validations\IsBoolean;
use Fedejuret\DtoBuilder\Attributes\Validations\IsInteger;
use Fedejuret\DtoBuilder\Attributes\Validations\IsString;
use Fedejuret\DtoBuilder\Attributes\Validations\Required;
use Fedejuret\DtoBuilder\Exceptions\ValidationException;
use Fedejuret\DtoBuilder\Traits\Loadable;

describe('1.1 test that library can validate primitives types.', function () {
	test('1.1.0 test that library can validate strings', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[IsString]
			private string $name;

			public function getName(): string
			{
				return $this->name;
			}

			public function setName(string $name): self
			{
				$this->name = $name;
				return $this;
			}
		};

		$dto = $class->loadFromArray([
			'name' => 'some',
		]);

		expect($dto->getName())->toBe('some');

		$class->loadFromArray([
			'name' => false,
		]);
	})->throws(ValidationException::class);

	test('1.1.1 test that library can validate booleans', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[IsBoolean]
			private bool $active;

			public function getActive(): bool
			{
				return $this->active;
			}

			public function setActive(bool $active): self
			{
				$this->active = $active;
				return $this;
			}
		};

		$dto = $class->loadFromArray([
			'active' => true,
		]);

		expect($dto->getActive())->toBeTrue();

		$class->loadFromArray([
			'active' => 1,
		]);
	})->throws(ValidationException::class);

	test('1.1.2 test that library can validate integers', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[IsInteger]
			private int $age;

			public function getAge(): int
			{
				return $this->age;
			}

			public function setAge(int $age): self
			{
				$this->age = $age;
				return $this;
			}
		};

		$dto = $class->loadFromArray([
			'age' => 23,
		]);

		expect($dto->getAge())->toBe(23);

		$class->loadFromArray([
			'age' => 'some',
		]);
	})->throws(ValidationException::class);

	test('1.1.3 test that library can validate integers with mins and max', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[IsInteger(min: 10, max: 20)]
			private int $age;

			public function getAge(): int
			{
				return $this->age;
			}

			public function setAge(int $age): self
			{
				$this->age = $age;
				return $this;
			}
		};

		$class->loadFromArray([
			'age' => 23,
		]);
	})->throws(ValidationException::class);

	test('1.1.4 test that library can validate arrays', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsArray]
			private array $metadata;

			public function getMetadata(): array
			{
				return $this->metadata;
			}

			public function setMetadata(array $metadata): self
			{
				$this->metadata = $metadata;
				return $this;
			}
		};

		$dto = $class->loadFromArray([
			'metadata' => [
				'some' => true,
			],
		]);

		expect($dto->getMetadata())->toBeArray()
			->and($dto->getMetadata()['some'])->toBeTrue();

		$class->loadFromArray([
			'age' => 'some',
		]);
	})->throws(ValidationException::class);

	test('1.1.5 test that library can validate date', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsDate]
			private string $birthday;

			public function getBirthday(): string
			{
				return $this->birthday;
			}

			public function setBirthday(string $birthday): self
			{
				$this->birthday = $birthday;
				return $this;
			}
		};

		$dto = $class->loadFromArray([
			'birthday' => '2001-09-09',
		]);

		expect($dto->getBirthday())->toBe('2001-09-09');

		$class->loadFromArray([
			'birthday' => 'some',
		]);
	})->throws(ValidationException::class);


	test('1.1.6 test that library can validate double', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[Fedejuret\DtoBuilder\Attributes\Validations\IsDate]
			private string $birthday;

			public function getBirthday(): string
			{
				return $this->birthday;
			}

			public function setBirthday(string $birthday): self
			{
				$this->birthday = $birthday;
				return $this;
			}
		};

		$dto = $class->loadFromArray([
			'birthday' => '2001-09-09',
		]);

		expect($dto->getBirthday())->toBe('2001-09-09');

		$class->loadFromArray([
			'birthday' => 'some',
		]);
	})->throws(ValidationException::class);


    test('1.1.7 test that library can set defaults values', function () {
        $class = new class() {
            use Loadable;

            #[Fedejuret\DtoBuilder\Attributes\Property]
            #[Fedejuret\DtoBuilder\Attributes\Validations\Required]
            #[Fedejuret\DtoBuilder\Attributes\Validations\IsBoolean]
            public bool $active = false;
        };

        $dto = $class->loadFromArray([]);

        expect($dto->active)->toBeFalse();
    });
});
