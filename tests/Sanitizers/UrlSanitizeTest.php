<?php

namespace Pgly\FormFields\Tests\Sanitizers;

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Sanitizers\UrlSanitize;

class UrlSanitizeTest extends TestCase
{
	public function testSanitize()
	{
		$sanitize = new UrlSanitize();
		$this->assertNull($sanitize->sanitize(''));
		$this->assertNull($sanitize->sanitize(null));
		$this->assertNull($sanitize->sanitize(0));
		$this->assertNull($sanitize->sanitize(false));

		$this->assertEquals('https://www.example.com', $sanitize->sanitize('https://www.example.com'));
		$this->assertEquals('http://www.example.com', $sanitize->sanitize('http://www.example.com'));
		$this->assertEquals('ftp://www.example.com', $sanitize->sanitize('ftp://www.example.com'));
		$this->assertEquals('https://www.example.com/path/to/file.html', $sanitize->sanitize('https://www.example.com/path/to/file.html'));
		$this->assertEquals('https://www.example.com?param=value', $sanitize->sanitize('https://www.example.com?param=value'));

		$this->assertNull($sanitize->sanitize('<script>alert(\'Hello World!\');</script>'));
	}
}
