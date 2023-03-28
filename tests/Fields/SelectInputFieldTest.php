<?php

use Pgly\FormFields\Fields\SelectInputField;
use Pgly\FormFields\Fields\RenderAttributes\SelectRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class SelectInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required', 'placeholder' => 'Test Placeholder']);

		$field = new SelectInputField($options);

		$render_attrs = new SelectRenderAttribute('one', ['one'=>'Item One', 'two'=>'Item Two']);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--12">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--select" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<select id="test_name" name="test_name" class="test-class" required="required" placeholder="Test Placeholder">';
		$expected_html .= '<option class="placeholder" value="">Test Placeholder</option>';
		$expected_html .= '<option value="one" selected="selected">Item One</option>';
		$expected_html .= '<option value="two" >Item Two</option>';
		$expected_html .= '</select>';

		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}

	public function testRenderWithDefaultValue()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->changeColumnSize(6);
		$options->changeDefaultValue('Test Value');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new SelectInputField($options);

		$render_attrs = new SelectRenderAttribute(null, ['one'=>'Item One', 'two'=>'Item Two']);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--select" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<select id="test_name" name="test_name" class="test-class" required="required">';
		$expected_html .= '<option class="placeholder" value="">Selecione uma das opções</option>';
		$expected_html .= '<option value="one" >Item One</option>';
		$expected_html .= '<option value="two" >Item Two</option>';
		$expected_html .= '</select>';

		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}

	public function testRenderWithEmptyValue()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->changeColumnSize(6);
		$options->changeDefaultValue('Test Value');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new SelectInputField($options);

		$render_attrs = new SelectRenderAttribute('', ['one'=>'Item One', 'two'=>'Item Two']);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--select" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<select id="test_name" name="test_name" class="test-class" required="required">';
		$expected_html .= '<option class="placeholder" value="">Selecione uma das opções</option>';
		$expected_html .= '<option value="one" >Item One</option>';
		$expected_html .= '<option value="two" >Item Two</option>';
		$expected_html .= '</select>';

		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}

	public function testRenderWithNoOptionalComps()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeColumnSize(6);
		$options->changeDefaultValue('Test Value');
		$options->addAttrs(['class' => 'test-class']);

		$field = new SelectInputField($options);

		$render_attrs = new SelectRenderAttribute('', ['one'=>'Item One', 'two'=>'Item Two']);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--select" data-name="test_name">';

		$expected_html .= '<select id="test_name" name="test_name" class="test-class">';
		$expected_html .= '<option class="placeholder" value="">Selecione uma das opções</option>';
		$expected_html .= '<option value="one" >Item One</option>';
		$expected_html .= '<option value="two" >Item Two</option>';
		$expected_html .= '</select>';

		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
