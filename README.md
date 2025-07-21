# DTO Builder

**DTO Builder** is a lightweight PHP library that streamlines the process of creating and populating Data Transfer Objects (DTOs) using PHP 8+ attributes. It enables dynamic property hydration, automatic validation, and conversion to arrays with minimal boilerplate.

---

## ✨ Features

* 📦 Instantiate DTOs from arrays
* 🧪 Attribute-based property validation
* 🖁️ Convert DTOs to arrays effortlessly
* ✅ PHP 8 attributes for configuration
* 🧹 Extendable and easy to integrate

---

## 📦 Installation

Install the package via Composer:

```bash
composer require fedejuret/dto-builder
```

---

## 🚀 Getting Started

### 1. Define Your DTO

```php
<?php

class CreateUserDto
{
    private string $firstName;
    private string $lastName;

    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): CreateUserDto
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): CreateUserDto
    {
        $this->lastName = $lastName;
        return $this;
    }
}
```

This requires calling setters manually for each property. **With DTO Builder**, you can simplify this dramatically.

---

### 2. Use Attributes for Property Mapping and Validation

```php
<?php

use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Attributes\Validations\IsBoolean;
use Fedejuret\DtoBuilder\Attributes\Validations\IsDate;
use Fedejuret\DtoBuilder\Attributes\Validations\IsEmail;
use Fedejuret\DtoBuilder\Attributes\Validations\Length;
use Fedejuret\DtoBuilder\Attributes\Validations\Required;
use Fedejuret\DtoBuilder\Attributes\Validations\IsString;
use Fedejuret\DtoBuilder\Traits\Loadable;
use Fedejuret\DtoBuilder\Traits\Arrayable;

class CreateUserDto
{
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

    // Getters and Setters...
}
```

---

## 🧰 Traits

### `Loadable`

Enables the `loadFromArray(array $data): self` method, which automatically maps input arrays to DTO properties based on defined attributes.

### `Arrayable`

Adds a `toArray(): array` method, which serializes the DTO to a key-value array using the attribute-defined property names.

---

## 🏷️ Attributes

### `#[Property]`

Defines mapping behavior for each DTO property.

| Attribute | Description                                                   |
| --------- | ------------------------------------------------------------- |
| `name`    | Overrides the array key name for hydration and serialization. |
| `setter`  | Specifies a custom setter method.                             |
| `getter`  | Specifies a custom getter method.                             |

---

## ✅ Built-in Validations

Use validation attributes to ensure the integrity of your DTO before hydration.

| Attribute                   | Description                                |
|-----------------------------|--------------------------------------------|
| `#[Required]`               | Ensures the value is present in the input. |
| `#[IsString]`               | Must be of type `string`.                  |
| `#[IsEmail]`                | Must be a valid email address.             |
| `#[IsDate]`                 | Must be a valid date string.               |
| `#[IsBoolean]`              | Must be a boolean (`true`/`false`).        |
| `#[IsNumeric]`              | Must be numeric.                           |
| `#[IsInteger]`              | Must be an integer.                        |
| `#[IsDouble]`               | Must be a double/float.                    |
| `#[IsArray]`                | Must be an array.                          |
| `#[IsDomain]`               | Must be a valid domain name.               |
| `#[IsIPAddress]`            | Must be a valid IP address.                |
| `#[Length(min, max)]`       | Validates the string length.               |
| `#[IsIn(availableValues)]`  | Validates if value is in array.            |
| `#[IsRegex(pattern)]`       | Validates if values match with regex.      |
| `#[IsUuid]`                 | Validates if values is a valid UUID.       |

---

## 🧼 Built-in Sanitizations

DTO Builder allows you to sanitize each property before validation and usage.

### `#[HtmlSanitization]`

Removes all HTML tags from a string, while optionally keeping specific safe tags.

```php
#[HtmlSanitization('<b><i><ul><li>')]
public string $comment;
```

- Uses `strip_tags()` internally.
- Useful for allowing basic formatting while stripping harmful tags like `<script>`.

### `#[SecureSanitization]`

A defensive sanitization designed to help mitigate OWASP Top 10 vulnerabilities like XSS.

```php
#[SecureSanitization]
public string $bio;
```

- Removes all tags unless specific ones are whitelisted.
- Escapes special characters (`<`, `>`, `'`, `"`, `&`) using `htmlspecialchars`.
- Removes invisible characters and normalizes whitespace.
- Optional parameter lets you keep specific HTML tags:

```php
#[SecureSanitization('<b><i>')]
public string $safeContent;
```

---

## 🛠️ Custom Sanitizations

You can create your own sanitizers by implementing the `SanitizationInterface` and marking them as attributes.

```php
use Fedejuret\DtoBuilder\Interfaces\SanitizationInterface;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class TrimSanitization implements SanitizationInterface
{
    public function sanitize(mixed &$value): void
    {
        if (is_string($value)) {
            $value = trim($value);
        }
    }
}
```

Usage:

```php
#[TrimSanitization]
public string $username;
```

Custom sanitizations allow you to apply reusable transformations to your data before validation or further processing.

---

## 🥪 Running Tests

Clone the repository and install dependencies:

```bash
composer install
composer run test
```

---

## 🤝 Contributing

Contributions are welcome! To get started:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -m 'Add new feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

Please follow the [PSR-12 coding standard](https://www.php-fig.org/psr/psr-12/) when contributing.

---

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

---

## 📢 Contact

* Email: [fedejuret@gmail.com](mailto:fedejuret@gmail.com)
* Website: [federicojuretich.com](https://federicojuretich.com)
* LinkedIn: [@federicojuretich](https://www.linkedin.com/in/federicojuretich/)