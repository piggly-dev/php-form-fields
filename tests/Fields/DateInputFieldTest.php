<?php

use Pgly\FormFields\Fields\RenderAttributes\BasicRenderAttribute;
use Pgly\FormFields\Fields\DateInputField;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class DateInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new DateInputField($options);

		$render_attrs = new BasicRenderAttribute('');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--12">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--text" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<input id="test_name" name="test_name" type="date" value="" class="test-class" required="required">';
		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
