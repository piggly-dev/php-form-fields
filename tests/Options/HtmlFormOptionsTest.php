<?php

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Options\HtmlFormOptions;

class HtmlFormOptionsTest extends TestCase
{
	public function testName()
	{
		$options = new HtmlFormOptions();
		$this->assertNull($options->name());
		$options->changeName('test');
		$this->assertEquals('test', $options->name());
	}

	public function testChangeLabels()
	{
		$options = new HtmlFormOptions();
		$this->assertEquals(['submit' => 'Submit'], $options->labels());
		$options->changeLabels('Submit Now');
		$this->assertEquals(['submit' => 'Submit Now'], $options->labels());
	}

	public function testChangeAction()
	{
		$options = new HtmlFormOptions();
		$this->assertNull($options->action());
		$options->changeAction('http://example.com/test');
		$this->assertEquals('http://example.com/test', $options->action());
	}

	public function testChangeMethod()
	{
		$options = new HtmlFormOptions();
		$this->assertNull($options->method());
		$options->changeMethod('GET');
		$this->assertEquals('GET', $options->method());
	}

	public function testChangeMethodInvalid()
	{
		$this->expectException(InvalidArgumentException::class);
		$options = new HtmlFormOptions();
		$options->changeMethod('INVALID');
	}

	public function testChangeRenderMode()
	{
		$options = new HtmlFormOptions();
		$this->assertEquals('form', $options->renderMode());
		$options->changeRenderMode('div');
		$this->assertEquals('div', $options->renderMode());
	}

	public function testChangeRenderModeInvalid()
	{
		$this->expectException(InvalidArgumentException::class);
		$options = new HtmlFormOptions();
		$options->changeRenderMode('INVALID');
	}
}
