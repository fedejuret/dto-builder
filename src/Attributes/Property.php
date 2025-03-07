<?php

namespace Fedejuret\DtoBuilder\Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Property
{
    /**
     * @param string|null $name
     * @param string|null $setter
     * @param string|null $getter
     */
    public function __construct(
        private ?string $name = null,
        private ?string $setter = null,
        private ?string $getter = null,
    ) {}

    public function getGetter(): ?string
    {
        return $this->getter;
    }

    public function setGetter(?string $getter): Property
    {
        $this->getter = $getter;
        return $this;
    }

    public function getSetter(): ?string
    {
        return $this->setter;
    }

    public function setSetter(?string $setter): Property
    {
        $this->setter = $setter;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Property
    {
        $this->name = $name;
        return $this;
    }

}