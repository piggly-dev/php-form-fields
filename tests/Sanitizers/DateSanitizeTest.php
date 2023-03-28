<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use DateTime;
use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\DateSanitize;

class DateSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new DateSanitize();
		$this->assertNull($sanitize->sanitize(''));
		$this->assertNull($sanitize->sanitize(null));
		$this->assertNull($sanitize->sanitize(0));
		$this->assertNull($sanitize->sanitize(false));

		$this->assertEquals('2022-01-01', $sanitize->sanitize(new DateTime('2022-01-01')));
		$this->assertEquals('2022-01-01', $sanitize->sanitize(new DateTime('2022-01-01 10:30:00')));
		$this->assertEquals('2022-01-01', $sanitize->sanitize('2022-01-01 10:30:00'));
		$this->assertEquals('0000-00-00', $sanitize->sanitize('<script>alert(\'Hello World!\');</script>'));
	}
}
