<?php

use Fedejuret\DtoBuilder\CreateUserDto;

describe('1.0: Can create user Dto', function () {

    test('1.1: Create Dto Successfully', function () {

        $dto = (new CreateUserDto())
            ->loadFromArray([
                'first_name' => 'Federico',
                'last_name' => 'Juretich'
            ]);

        expect($dto instanceof CreateUserDto);
        expect($dto->getFirstName())->toBe('Federico')
            ->and($dto->getLastName())->toBe('Juretich')
            ->and($dto->toArray())->toBe([
                'first_name' => 'Federico',
                'last_name' => 'Juretich'
            ]);
    });

    test('1.2: must trow exception because lastname was required', function () {
        (new CreateUserDto())
            ->loadFromArray([
                'first_name' => 'Federico',
            ]);
    })->throws(Exception::class);

});
