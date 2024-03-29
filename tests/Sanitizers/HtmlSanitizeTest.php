<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\HtmlSanitize;

class HtmlSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new HtmlSanitize();
		$this->assertNull($sanitize->sanitize(null));

		$this->assertEquals('&lt;script&gt;alert(\'Hello World!\');&lt;/script&gt;', $sanitize->sanitize('<script>alert(\'Hello World!\');</script>'));
		$this->assertEquals('string', $sanitize->sanitize('string'));
	}
}
