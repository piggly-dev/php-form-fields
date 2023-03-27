<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\FloatSanitize;

class FloatSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new FloatSanitize();
		$this->assertNull($sanitize->sanitize(''));
		$this->assertNull($sanitize->sanitize(null));
		$this->assertNull($sanitize->sanitize(false));

		$this->assertEquals(0.0, $sanitize->sanitize(0));
		$this->assertEquals(10.0, $sanitize->sanitize('10'));
		$this->assertEquals(10.342, $sanitize->sanitize('10.342'));
		$this->assertEquals(10.0, $sanitize->sanitize(10));
		$this->assertEquals(10.2546, $sanitize->sanitize(10.2546));
		$this->assertEquals(1.0, $sanitize->sanitize(true));
		$this->assertEquals(0.0, $sanitize->sanitize('any'));
	}
}
