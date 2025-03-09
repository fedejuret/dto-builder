<?php

describe('1.0: Can create user Dto', function () {

    test('1.1: Create Dto Successfully', function () {

        $dto = getDtoClass()
            ->loadFromArray([
                'first_name' => 'Federico',
                'last_name' => 'Juretich',
                'birthday' => '2001-09-09',
                'email' => 'hola@federicojuretich.com',
                'email_sent' => false,
            ]);

        expect($dto->getFirstName())->toBe('Federico')
            ->and($dto->getLastName())->toBe('Juretich')
            ->and($dto->toArray())->toBe([
                'first_name' => 'Federico',
                'last_name' => 'Juretich',
                'birthday' => '2001-09-09',
                'email' => 'hola@federicojuretich.com',
                'email_sent' => false,
            ]);
    });

    test('1.2: must trow exception because lastname was required', function () {
        getDtoClass()
            ->loadFromArray([
                'first_name' => 'Federico',
            ]);
    })->throws(\Fedejuret\DtoBuilder\Exceptions\ValidationException::class);

    test('1.3: must trow exception because property was repeated', function () {
        getDtoRepeatedPropertyAttributeClass()
            ->loadFromArray([
                'first_name' => 'Federico',
            ]);
    })->throws(\Fedejuret\DtoBuilder\Exceptions\RepeatedAttributeException::class);

});
