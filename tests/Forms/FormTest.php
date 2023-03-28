<?php

use Pgly\FormFields\Collections\FieldsCollection;
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
	public function testOptions()
	{
		$options = new HtmlFormOptions();
		$form = new Form(new FieldsCollection(), $options);
		$this->assertEquals($options, $form->options());
	}

	public function testToGroup()
	{
		$form = new Form(new FieldsCollection());
		$group = $form->toGroup(new HtmlGroupFormOptions());
		$this->assertInstanceOf(GroupForm::class, $group);
	}

	public function testRenderHeader()
	{
		$options = new HtmlFormOptions();

		$options->changeAction('http://example.com');
		$options->changeMethod('POST');
		$options->changeName('test_name');

		$form = new Form(new FieldsCollection(), $options);

		$expected_html  = '<form id="test_name" name="test_name" action="http://example.com" method="POST" >';
		$expected_html .= '<div class="pgly-wps--row"><div class="pgly-wps--column">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-primary pgly-async--behaviour pgly-form--submit">Submit<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></button>';
		$expected_html .= '</div></div>';

		$this->assertEquals($expected_html, $form->renderHeader());
	}

	public function testRenderFooter()
	{
		$options = new HtmlFormOptions();

		$options->action('http://example.com');
		$options->method('POST');
		$options->name('test_name');

		$form = new Form(new FieldsCollection(), $options);

		$expected_html  = '<div class="pgly-wps--row"><div class="pgly-wps--column">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-primary pgly-async--behaviour pgly-form--submit">Submit<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg></button>';
		$expected_html .= '</div></div>';
		$expected_html .= '</form>';

		$this->assertEquals($expected_html, $form->renderFooter());
	}
}
