<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

// pest()->extend(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Attributes\Validations\IsBoolean;
use Fedejuret\DtoBuilder\Attributes\Validations\IsDate;
use Fedejuret\DtoBuilder\Attributes\Validations\IsEmail;
use Fedejuret\DtoBuilder\Attributes\Validations\IsString;
use Fedejuret\DtoBuilder\Attributes\Validations\Length;
use Fedejuret\DtoBuilder\Attributes\Validations\Required;
use Fedejuret\DtoBuilder\Traits\Arrayable;
use Fedejuret\DtoBuilder\Traits\Loadable;

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function getDtoClass(): object
{
	return new class() {
		use Arrayable, Loadable;

		#[Property(name: 'first_name')]
		#[Length(min: 4, max: 255)]
		private string $firstName;

		#[Property(name: 'last_name')]
		#[IsString]
		#[Length(min: 8, max: 255)]
		private string $lastName;

		#[Property]
		#[IsDate]
		private string $birthday;

		#[Property]
		#[Required]
		#[IsEmail]
		private string $email;

		#[Property(name: 'email_sent')]
		#[Required]
		#[IsBoolean]
		private bool $emailSent;

		public function getEmailSent(): bool
		{
			return $this->emailSent;
		}

		public function setEmailSent(bool $emailSent)
		{
			$this->emailSent = $emailSent;
			return $this;
		}

		public function getEmail(): string
		{
			return $this->email;
		}

		public function setEmail(string $email)
		{
			$this->email = $email;
			return $this;
		}

		public function getBirthday(): string
		{
			return $this->birthday;
		}

		public function setBirthday(string $birthday)
		{
			$this->birthday = $birthday;
			return $this;
		}

		public function getFirstName(): string
		{
			return $this->firstName;
		}

		public function setFirstName(string $firstName)
		{
			$this->firstName = $firstName;
			return $this;
		}

		public function getLastName(): string
		{
			return $this->lastName;
		}

		public function setLastName(string $lastName)
		{
			$this->lastName = $lastName;
			return $this;
		}
	};
}

function getDtoRepeatedPropertyAttributeClass(): object
{
	return new class() {
		use Arrayable, Loadable;

		#[Property(name: 'first_name')]
		#[Property]
		#[Length(min: 4, max: 255)]
		private string $firstName;

		#[Property(name: 'last_name')]
		#[IsString]
		#[Length(min: 8, max: 255)]
		private string $lastName;

		#[Property]
		#[IsDate]
		private string $birthday;

		#[Property]
		#[Required]
		#[IsEmail]
		private string $email;

		#[Property(name: 'email_sent')]
		#[Required]
		#[IsBoolean]
		private bool $emailSent;

		public function getEmailSent(): bool
		{
			return $this->emailSent;
		}

		public function setEmailSent(bool $emailSent)
		{
			$this->emailSent = $emailSent;
			return $this;
		}

		public function getEmail(): string
		{
			return $this->email;
		}

		public function setEmail(string $email)
		{
			$this->email = $email;
			return $this;
		}

		public function getBirthday(): string
		{
			return $this->birthday;
		}

		public function setBirthday(string $birthday)
		{
			$this->birthday = $birthday;
			return $this;
		}

		public function getFirstName(): string
		{
			return $this->firstName;
		}

		public function setFirstName(string $firstName)
		{
			$this->firstName = $firstName;
			return $this;
		}

		public function getLastName(): string
		{
			return $this->lastName;
		}

		public function setLastName(string $lastName)
		{
			$this->lastName = $lastName;
			return $this;
		}
	};
}
