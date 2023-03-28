<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\BooleanSanitize;

class BooleanSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new BooleanSanitize();
		$this->assertFalse($sanitize->sanitize(''));
		$this->assertFalse($sanitize->sanitize(null));
		$this->assertFalse($sanitize->sanitize(0));
		$this->assertFalse($sanitize->sanitize('0'));
		$this->assertFalse($sanitize->sanitize(false));
		$this->assertFalse($sanitize->sanitize('false'));
		$this->assertFalse($sanitize->sanitize('off'));
		$this->assertTrue($sanitize->sanitize('any'));
		$this->assertTrue($sanitize->sanitize(1));
		$this->assertTrue($sanitize->sanitize('1'));
		$this->assertTrue($sanitize->sanitize(true));
		$this->assertTrue($sanitize->sanitize('true'));
		$this->assertTrue($sanitize->sanitize('on'));
	}
}
