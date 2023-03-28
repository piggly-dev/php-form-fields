<?php

use Pgly\FormFields\Collections\FieldsCollection;
use Pgly\FormFields\Fields\RenderAttributes\BasicRenderAttribute;
use Pgly\FormFields\Fields\TextInputField;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class FieldsCollectionTest extends TestCase
{
	public function testAddField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$collection = new FieldsCollection();
		$collection->add($field);
		$this->assertContains($field, $collection->getAll());
	}

	public function testGetField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$collection = new FieldsCollection();
		$collection->add($field);
		$this->assertEquals($field, $collection->get('test_name'));
	}

	public function testRenderField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$collection = new FieldsCollection();
		$collection->add($field);
		$this->assertIsString($collection->render('test_field', new BasicRenderAttribute('')));
	}

	public function testRemoveField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$collection = new FieldsCollection();
		$collection->add($field);
		$collection->remove('test_name');
		$this->assertNotContains($field, $collection->getAll());
	}

	public function testOrganizeFields()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_one');
		$field_1 = new TextInputField($options);

		$options = new HtmlFieldOptions();
		$options->changeName('test_two')->changeColumnSize(6);
		$field_2 = new TextInputField($options);

		$options = new HtmlFieldOptions();
		$options->changeName('test_three')->changeColumnSize(6);
		$field_3 = new TextInputField($options);

		$options = new HtmlFieldOptions();
		$options->changeName('test_four');
		$field_4 = new TextInputField($options);

		$collection = new FieldsCollection();
		$collection->add($field_1);
		$collection->add($field_2);
		$collection->add($field_3);
		$collection->add($field_4);

		$this->assertEquals([
			[
				$field_1,
			],
			[
				$field_2,
				$field_3
			],
			[
				$field_4
			]
		], $collection->organizeIntoRows());
	}
}
