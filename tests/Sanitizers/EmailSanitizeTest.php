<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\EmailSanitize;

class EmailSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new EmailSanitize();
		$this->assertNull($sanitize->sanitize(''));
		$this->assertNull($sanitize->sanitize(null));
		$this->assertNull($sanitize->sanitize(0));
		$this->assertNull($sanitize->sanitize(false));

		$this->assertEquals('johndoe@gmail.com', $sanitize->sanitize('johndoe@gmail.com'));
		$this->assertNull($sanitize->sanitize('<script>alert(\'Hello World!\');</script>'));
	}
}
