<?php

namespace Fedejuret\DtoBuilder;


use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Attributes\Validations\Boolean;
use Fedejuret\DtoBuilder\Attributes\Validations\Date;
use Fedejuret\DtoBuilder\Attributes\Validations\Email;
use Fedejuret\DtoBuilder\Attributes\Validations\Length;
use Fedejuret\DtoBuilder\Attributes\Validations\Required;
use Fedejuret\DtoBuilder\Attributes\Validations\Text;
use Fedejuret\DtoBuilder\Traits\Loadable;
use Fedejuret\DtoBuilder\Traits\Arrayable;

class CreateUserDto
{
    use Arrayable, Loadable;

    #[Property(name: 'first_name')]
    #[Length(min: 4, max: 255)]
    private string $firstName;

    #[Property(name: 'last_name')]
    #[Text]
    #[Length(min: 8, max: 255)]
    private string $lastName;

    #[Property]
    #[Date]
    private string $birthday;

    #[Property]
    #[Required]
    #[Email]
    private string $email;

    #[Property(name: 'email_sent')]
    #[Required]
    #[Boolean]
    private bool $emailSent;

    public function getEmailSent(): bool
    {
        return $this->emailSent;
    }

    public function setEmailSent(bool $emailSent): CreateUserDto
    {
        $this->emailSent = $emailSent;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): CreateUserDto
    {
        $this->email = $email;
        return $this;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): CreateUserDto
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): CreateUserDto
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): CreateUserDto
    {
        $this->lastName = $lastName;
        return $this;
    }
}