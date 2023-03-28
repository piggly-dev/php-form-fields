<?php

use Pgly\FormFields\Fields\RenderAttributes\BasicRenderAttribute;
use Pgly\FormFields\Fields\TextInputField;
use Pgly\FormFields\Forms\Form;
use Pgly\FormFields\Forms\GroupForm;
use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Options\HtmlFormOptions;
use Pgly\FormFields\Options\HtmlGroupFormOptions;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
	public function testAddField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$form = new Form();
		$form->addField($field);
		$this->assertContains($field, $form->getFields());
	}

	public function testGetField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$form = new Form();
		$form->addField($field);
		$this->assertEquals($field, $form->getField('test_name'));
	}

	public function testRenderField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$form = new Form();
		$form->addField($field);
		$this->assertIsString($form->renderField('test_field', new BasicRenderAttribute('')));
	}

	public function testRemoveField()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$field = new TextInputField($options);

		$form = new Form();
		$form->addField($field);
		$form->removeField('test_name');
		$this->assertNotContains($field, $form->getFields());
	}

	public function testOptions()
	{
		$options = new HtmlFormOptions();
		$form = new Form($options);
		$this->assertEquals($options, $form->options());
	}

	public function testToGroup()
	{
		$form = new Form();
		$group = $form->toGroup(new HtmlGroupFormOptions());
		$this->assertInstanceOf(GroupForm::class, $group);
	}

	public function testRenderHeader()
	{
		$options = new HtmlFormOptions();

		$options->changeAction('http://example.com');
		$options->changeMethod('POST');
		$options->changeName('test_name');

		$form = new Form($options);

		$expected_html  = '<form id="test_name" name="test_name" action="http://example.com" method="POST" >';
		$expected_html .= '<div class="pgly-wps--row"><div class="pgly-wps--column">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-primary pgly-async--behaviour pgly-form--submit">Submit<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></button>';
		$expected_html .= '</div></div>';

		$this->assertEquals($expected_html, $form->renderHeader());
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

		$form = new Form();
		$form->addField($field_1);
		$form->addField($field_2);
		$form->addField($field_3);
		$form->addField($field_4);

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
		], $form->organizeFields());
	}

	public function testRenderFooter()
	{
		$options = new HtmlFormOptions();

		$options->action('http://example.com');
		$options->method('POST');
		$options->name('test_name');

		$form = new Form($options);

		$expected_html  = '<div class="pgly-wps--row"><div class="pgly-wps--column">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-primary pgly-async--behaviour pgly-form--submit">Submit<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></button>';
		$expected_html .= '</div></div>';
		$expected_html .= '</form>';

		$this->assertEquals($expected_html, $form->renderFooter());
	}
}
