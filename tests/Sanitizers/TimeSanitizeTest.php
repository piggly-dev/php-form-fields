<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use DateTime;
use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\TimeSanitize;

class TimeSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new TimeSanitize();
		$this->assertNull($sanitize->sanitize(''));
		$this->assertNull($sanitize->sanitize(null));
		$this->assertNull($sanitize->sanitize(0));
		$this->assertNull($sanitize->sanitize(false));

		$this->assertEquals('10:30', $sanitize->sanitize(new DateTime('2022-01-01 10:30:00')));
		$this->assertEquals('10:30', $sanitize->sanitize('2022-01-01 10:30:00'));
		$this->assertEquals('00:00', $sanitize->sanitize('<script>alert(\'Hello World!\');</script>'));
	}
}
