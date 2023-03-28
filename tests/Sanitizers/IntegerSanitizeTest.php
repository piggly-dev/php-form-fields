<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\IntegerSanitize;

class IntegerSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new IntegerSanitize();
		$this->assertNull($sanitize->sanitize(''));
		$this->assertNull($sanitize->sanitize(null));
		$this->assertNull($sanitize->sanitize(false));

		$this->assertEquals(0, $sanitize->sanitize(0));
		$this->assertEquals(10, $sanitize->sanitize('10'));
		$this->assertEquals(10, $sanitize->sanitize(10));
		$this->assertEquals(10, $sanitize->sanitize(10.2546));
		$this->assertEquals(1, $sanitize->sanitize(true));
		$this->assertEquals(0, $sanitize->sanitize('any'));
	}
}
