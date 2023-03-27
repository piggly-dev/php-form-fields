<?php

use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Options\HtmlGroupFormOptions;

class HtmlGroupFormOptionsTest extends TestCase
{
	public function testName()
	{
		$options = new HtmlGroupFormOptions();
		$this->assertNull($options->name());
		$options->changeName('test');
		$this->assertEquals('test', $options->name());
	}

	public function testChangeLabels()
	{
		$options = new HtmlGroupFormOptions();
		$this->assertEquals([
			'submit' => 'Add Data',
			'cancel' => 'Cancel'
		], $options->labels());
		$options->changeLabels('Submit Now', 'Cancel Now');
		$this->assertEquals([
			'submit' => 'Submit Now',
			'cancel' => 'Cancel Now'
		], $options->labels());
	}
}
