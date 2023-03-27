<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use Pgly\FormFields\Sanitizers\ArrayOfSanitize;
use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\BooleanSanitize;

class ArrayOfSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new ArrayOfSanitize(new BooleanSanitize());

		$arr = [
			'',
			null,
			0,
			'0',
			false,
			'false',
			'off',
			'any',
			1,
			'1',
			true,
			'true',
			'on',
		];

		$this->assertEquals([
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			true,
			true,
			true,
			true,
			true,
			true,
		], $sanitize->sanitize($arr));
	}
}
