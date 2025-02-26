<?php

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Attributes\Property;

trait Loadable
{
    use PropertyTrait;

    public function loadFromArray(array $array): self {

        $props = (new \ReflectionClass(static::class))->getProperties();

        foreach ($props as $prop) {
            $attributes = $prop->getAttributes(Property::class);
            if ($attributes[0]->isRepeated()) {
                //TODO: Change for custom exception
                throw new \Exception('Tributes repeated');
            }

            foreach ($attributes as $attribute) {
                $property = $attribute->newInstance();
                $indexName = $this->getName($prop, $property);

                $value = $array[$indexName] ?? null;

                if ($value === null && $this->isRequired($property)) {
                    throw new \Exception(sprintf('[%s] is required', $indexName));
                }

                $setter = $this->getSetter($prop, $property);
                if (method_exists($this, $setter)) {
                    $this->$setter($value);
                } else {
                    $prop->setValue($this, $value);
                }
            }
        }

        return $this;
    }

}