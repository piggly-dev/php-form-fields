<?php

use Pgly\FormFields\Fields\ExtendedCheckboxInputField;
use Pgly\FormFields\Fields\RenderAttributes\BasicRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class ExtendedCheckboxInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->changeDefaultValue(false);
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new ExtendedCheckboxInputField($options);

		$render_attrs = new BasicRenderAttribute(true);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--12">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--checkbox" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<div id="test_name" class="pgly-wps--checkbox" data-value="true" class="test-class" required="required">';
		$expected_html .= '<div class="pgly-wps--icon"></div>';
		$expected_html .= '<div class="pgly-wps--placeholder"></div>';
		$expected_html .= '</div>';
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

		$field = new ExtendedCheckboxInputField($options);

		$render_attrs = new BasicRenderAttribute(null);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--checkbox" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<div id="test_name" class="pgly-wps--checkbox" data-value="false" class="test-class" required="required">';
		$expected_html .= '<div class="pgly-wps--icon"></div>';
		$expected_html .= '<div class="pgly-wps--placeholder"></div>';
		$expected_html .= '</div>';
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

		$field = new ExtendedCheckboxInputField($options);

		$render_attrs = new BasicRenderAttribute(null);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--checkbox" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<div id="test_name" class="pgly-wps--checkbox" data-value="false" class="test-class" required="required">';
		$expected_html .= '<div class="pgly-wps--icon"></div>';
		$expected_html .= '<div class="pgly-wps--placeholder"></div>';
		$expected_html .= '</div>';
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

		$field = new ExtendedCheckboxInputField($options);

		$render_attrs = new BasicRenderAttribute(null);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--checkbox" data-name="test_name">';
		$expected_html .= '<div id="test_name" class="pgly-wps--checkbox" data-value="false" class="test-class">';
		$expected_html .= '<div class="pgly-wps--icon"></div>';
		$expected_html .= '<div class="pgly-wps--placeholder"></div>';
		$expected_html .= '</div>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
