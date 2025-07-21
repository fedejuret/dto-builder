<?php

declare(strict_types=1);

use Fedejuret\DtoBuilder\Attributes\Property;
use Fedejuret\DtoBuilder\Attributes\Sanitizations\HtmlSanitization;
use Fedejuret\DtoBuilder\Attributes\Sanitizations\SecureSanitization;
use Fedejuret\DtoBuilder\Attributes\Validations\Required;
use Fedejuret\DtoBuilder\Traits\Loadable;

describe('1.4 test sanitization methods', function () {
	test('1.4.0 test that library can strip html tags', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[HtmlSanitization('<br><ul><li>')]
			public string $description;
		};

		$instance = $class->loadFromArray([
			'description' => 'Some test with <strong>html tags</strong> but others tags <br> will keep. Example <ul><li>Fede</li><li>Fede 2</li></ul>',
		]);

		expect($instance->description)->toBe(
			'Some test with html tags but others tags <br> will keep. Example <ul><li>Fede</li><li>Fede 2</li></ul>'
		);
	});

	test('1.4.1 test that SecureSanitization strips and escapes unsafe input', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[SecureSanitization]
			public string $bio;
		};

		$instance = $class->loadFromArray([
			'bio' => "<script>alert('XSS');</script>  Hello <b>World</b> & goodbye\t\n",
		]);

		expect($instance->bio)->toBe('alert(&#039;XSS&#039;); Hello World &amp; goodbye');
	});

	test('1.4.2 test that SecureSanitization can preserve safe tags', function () {
		$class = new class() {
			use Loadable;

			#[Property]
			#[Required]
			#[SecureSanitization('<b><i>')]
			public string $bio;
		};

		$instance = $class->loadFromArray([
			'bio' => "<b>Safe</b> <i>Text</i> <script>bad()</script> <a href='#'>link</a>",
		]);

		expect($instance->bio)->toBe('<b>Safe</b> <i>Text</i> bad() link');
	});
});
