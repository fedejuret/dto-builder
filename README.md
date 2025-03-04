# DTO Builder

DTO Builder es una librería de php que permite la instanciación de los valores de los DTOs de forma dinámica mediante la característica de atributos introducida en PHP +8.0.

## ¿Como usar?

Instala la librería usando:
```bash
composer require fedejuret/dto-builder
```

Luego, crea tu DTO de forma normal. Ejemplo:
```php
<?php

class CreateUserDto
{
    private string $firstName;
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
```

Ahora, de esta manera, te ves obligado a llamar al método setFirstName y setLastName para setear los valores.
**¿Qué tal si lo mejoramos un poco?**

Sería algo asi cómo:
```php

<?php

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

```

## Arrayable
Este trait habilita el método `toArray()` en el DTO. Básicamente, convierte el dto en un array "clave" "valor".

## Loadable
Este trait es quien habilita el método `loadFromArray($array)` en el dto. En este caso, deberías pasarle el array completo matcheando el nombre de las propiedades para que así se les de un valor mediante los setters.

## Property Attribute #[Property]
Este atributo sirve para configurar la propiedad del dto.
* name: setea el nombre con el que la propiedad será devuelta en el método toArray y tambien cómo será buscadá dentro del array en el método loadFromArray.
* required: si la propiedad es requerida. Al ejecutar loadFromArray si la propiedad no está dentro del array, entonces se lanza una excepción.
* setter: especifica el nombre del método setter que se quiere usar.
* getter: especifica el nombre del getter que se quiere usar.

## Validaciones con atributos
Antes de cargar el valor en la propiedad, puedes correr una serie de validaciones mediante atributos. Entre ellas estan:

* #[Required]: Valida que la propiedad se envíe en el array
* #[Text]: Valida que sea de tipo string
* #[Length(min and max)]: Valida longitudes de una cadena de texto
* #[Email]: Verifica que el email enviado tenga formato de email
* #[Domain]: Valida que la cadena de texto enviada sea un dominio
* #[IPAddress]: Verifica que la cadena de texto enviada sea una IP
* #[Numeric]: Valida que el dato enviado sea un numero
* #[Boolean]: Valida que el dato enviado sea un booleano
* #[Date]: Verifica que el dato enviado sea una fecha valida.

## Tests
Cloná el repositorio:
```bash
composer install && composer run test
```

## Contacto
Email: fedejuret@gmail.com<br>
Website: https://federicojuretich.com<br>
LinkedIn: https://www.linkedin.com/in/federicojuretich/