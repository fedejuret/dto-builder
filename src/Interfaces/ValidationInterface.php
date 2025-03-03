<?php

namespace Fedejuret\DtoBuilder\Interfaces;

interface ValidationInterface
{
    public function validate (\ReflectionProperty $property, mixed $value) : void;

}