<?php

namespace Fedejuret\DtoBuilder\Traits;

use Fedejuret\DtoBuilder\Attributes\Property;

trait Arrayable
{

    public function toArray(): array {
        $array = [];

        $props = (new \ReflectionClass(static::class))->getProperties();

        foreach ($props as $prop) {

            if (count($prop->getAttributes(Property::class)) === 0) {
                continue;
            }

            $attributes = $prop->getAttributes(Property::class);
            if ($attributes[0]->isRepeated()) {
                //TODO: Change for custom exception
                throw new \Exception('Tributes repeated');
            }

            foreach ($attributes as $attribute) {
                $property = $attribute->newInstance();
                $indexName = $this->getName($prop, $property);

                $getter = $this->getGetter($prop, $property);

                if (method_exists($this, $getter)) {
                    $value = $this->{$getter}();
                } else {
                    $value = $this->{$prop->getName()};
                }

                $array[$indexName] = $value;
            }
        }

        return $array;
    }

}