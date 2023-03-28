<?php

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;
use Pgly\FormFields\Interfaces\ValidatableCallbackInterface;
use PHPUnit\Framework\TestCase;
use Pgly\FormFields\Options\HtmlFieldOptions;

class HtmlFieldOptionsTest extends TestCase
{
	public function testName()
	{
		$options = new HtmlFieldOptions();
		$this->assertNull($options->name());
		$options->changeName('test');
		$this->assertEquals('test', $options->name());
	}

	public function testChangeLabel()
	{
		$options = new HtmlFieldOptions();
		$this->assertNull($options->label());
		$options->changeLabel('test');
		$this->assertEquals('test', $options->label());
	}

	public function testChangeType()
	{
		$options = new HtmlFieldOptions();
		$this->assertNull($options->type());
		$options->changeType('test');
		$this->assertEquals('test', $options->type());
	}

	public function testChangeDefaultValue()
	{
		$options = new HtmlFieldOptions();
		$this->assertNull($options->defaultValue());
		$options->changeDefaultValue('test');
		$this->assertEquals('test', $options->defaultValue());
	}

	public function testChangeDescription()
	{
		$options = new HtmlFieldOptions();
		$this->assertNull($options->description());
		$options->changeDescription('test');
		$this->assertEquals('test', $options->description());
	}

	public function testChangePrefix()
	{
		$options = new HtmlFieldOptions();
		$options->changePrefix('test');
		$this->assertEquals('test', $options->prefix());
	}

	public function testPrefixedName()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test');
		$options->changePrefix('prefix');
		$this->assertEquals('prefix_test', $options->prefixedName());
		$this->assertEquals('prefix-test', $options->prefixedName('-'));
	}

	public function testAllowOnlyValues()
	{
		$options = new HtmlFieldOptions();
		$options->allowOnlyValues(['test']);
		$this->assertTrue($options->isAllowed('test'));
		$this->assertFalse($options->isAllowed('not_allowed'));
	}

	public function testSanitizeWith()
	{
		$mock = new class () implements SanitizableCallbackInterface {
			public function sanitize($value)
			{
				return 'sanitized';
			}
		};

		$options = new HtmlFieldOptions();
		$options->sanitizeWith($mock);
		$this->assertEquals('sanitized', $options->sanitize('test'));
	}

	public function testCleanSanitizers()
	{
		$mock = new class () implements SanitizableCallbackInterface {
			public function sanitize($value)
			{
				return 'sanitized';
			}
		};

		$options = new HtmlFieldOptions();
		$options->sanitizeWith($mock);
		$options->cleanSanitizers();
		$this->assertEquals('test', $options->sanitize('test'));
	}

	public function testSanitizeReturnsSameValueWhenSanitizingIsEmpty()
	{
		$options = new HtmlFieldOptions();
		$this->assertEquals('test', $options->sanitize('test'));
	}

	public function testValidateWith()
	{
		$mock = new class () implements ValidatableCallbackInterface {
			public function validate($value)
			{
				throw new Exception('Invalid');
			}
		};

		$this->expectException(Exception::class);
		$options = new HtmlFieldOptions();
		$options->validateWith($mock);
		$options->validate('test');
	}

	public function testAssert()
	{
		$mock = new class () implements ValidatableCallbackInterface {
			public function validate($value)
			{
				throw new Exception('Invalid');
			}
		};

		$options = new HtmlFieldOptions();
		$options->validateWith($mock);
		$this->assertEquals(false, $options->assert('test'));
		$options->cleanValidations();
		$this->assertEquals(true, $options->assert('test'));
	}

	public function testColumnSize()
	{
		$options = new HtmlFieldOptions();
		$this->assertEquals(12, $options->columnSize());
		$options->changeColumnSize(6);
		$this->assertEquals(6, $options->columnSize());
	}

	public function testOnGroup()
	{
		$options = new HtmlFieldOptions();
		$this->assertEquals(false, $options->isOnGroup());
		$options->onGroup(true);
		$this->assertEquals(true, $options->isOnGroup());
		$options->notOnGroup(true);
		$this->assertEquals(false, $options->isOnGroup());
	}

	public function testAddAttr()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$this->assertEquals('value', $options->getAttr('test'));
	}

	public function testAddAttrs()
	{
		$options = new HtmlFieldOptions();
		$options->addAttrs(['test' => 'value']);
		$this->assertEquals('value', $options->getAttr('test'));
	}

	public function testAppendAttr()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$options->appendAttr('test', 'value2');
		$this->assertEquals('value value2', $options->getAttr('test'));
	}

	public function testAppendAttrs()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$options->appendAttrs(['test' => 'value2']);
		$this->assertEquals('value value2', $options->getAttr('test'));
	}

	public function testRemoveAttr()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$options->removeAttr('test');
		$this->assertNull($options->getAttr('test'));
	}

	public function testRemoveAttrs()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$options->addAttr('test2', 'value');
		$options->removeAttrs(['test', 'test2']);
		$this->assertNull($options->getAttr('test'));
		$this->assertNull($options->getAttr('test2'));
	}

	public function testHasAttr()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$this->assertTrue($options->hasAttr('test'));
		$this->assertFalse($options->hasAttr('test2'));
	}

	public function testAttrs()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$options->addAttr('test2', 'value');
		$this->assertEquals(['test' => 'value', 'test2' => 'value'], $options->getAttrs());
	}

	public function testAttrsAsString()
	{
		$options = new HtmlFieldOptions();
		$options->addAttr('test', 'value');
		$options->addAttr('test2', 'value');
		$this->assertEquals('test="value" test2="value"', $options->attrs());
	}
}
