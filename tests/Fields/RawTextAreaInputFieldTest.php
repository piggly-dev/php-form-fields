<?php

use Pgly\FormFields\Fields\RenderAttributes\BasicRenderAttribute;
use Pgly\FormFields\Fields\RawTextAreaInputField;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class RawTextAreaInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->changeColumnSize(6);
		$options->changeDefaultValue('Test Value');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new RawTextAreaInputField($options);

		$render_attrs = new BasicRenderAttribute('My New Value');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--textarea" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<textarea id="test_name" name="test_name" class="test-class" required="required">My New Value</textarea>';
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

		$field = new RawTextAreaInputField($options);

		$render_attrs = new BasicRenderAttribute(null);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--textarea" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<textarea id="test_name" name="test_name" class="test-class" required="required">Test Value</textarea>';
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

		$field = new RawTextAreaInputField($options);

		$render_attrs = new BasicRenderAttribute('');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--textarea" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<textarea id="test_name" name="test_name" class="test-class" required="required"></textarea>';
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

		$field = new RawTextAreaInputField($options);

		$render_attrs = new BasicRenderAttribute('');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--textarea" data-name="test_name">';
		$expected_html .= '<textarea id="test_name" name="test_name" class="test-class"></textarea>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
