<?php

namespace Fedejuret\DtoBuilder;


use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Attributes\Validations\Required;
use Fedejuret\DtoBuilder\Traits\Loadable;
use Fedejuret\DtoBuilder\Traits\Arrayable;

class CreateUserDto
{
    use Arrayable, Loadable;

    #[Property(name: 'first_name')]
    private string $firstName;

    #[Property(name: 'last_name')]
    #[Required]
    private string $lastName;

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