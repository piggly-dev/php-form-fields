<?php

use Pgly\FormFields\Fields\ExtendedMultipleMediaInputField;
use Pgly\FormFields\Fields\RenderAttributes\BasicRenderAttribute;
use Pgly\FormFields\Fields\RenderAttributes\ExtendedMultipleMediaRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class ExtendedMultipleMediaInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new ExtendedMultipleMediaInputField($options);

		$render_attrs = new ExtendedMultipleMediaRenderAttribute([1, 2], ['http://localhost/image_1.png', 'http://localhost/image_2.png']);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--12">';
		$expected_html .= '<div class="pgly-wps--field pgly-wps--media-wrapper pgly-form--input pgly-form--multiple-media" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<div id="test_name" class="pgly-wps--images" class="test-class" required="required" data-values="1,2" data-srcs="http://localhost/image_1.png,http://localhost/image_2.png"></div>';
		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';
		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Add More</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean All</button>';
		$expected_html .= '</div>';
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
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new ExtendedMultipleMediaInputField($options);

		$render_attrs = new ExtendedMultipleMediaRenderAttribute([], []);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-wps--media-wrapper pgly-form--input pgly-form--multiple-media" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';
		$expected_html .= '<div id="test_name" class="pgly-wps--images" class="test-class" required="required" data-values="" data-srcs=""></div>';
		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';
		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Add More</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean All</button>';
		$expected_html .= '</div>';
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

		$field = new ExtendedMultipleMediaInputField($options);

		$render_attrs = new ExtendedMultipleMediaRenderAttribute([], []);
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-wps--media-wrapper pgly-form--input pgly-form--multiple-media" data-name="test_name">';
		$expected_html .= '<div id="test_name" class="pgly-wps--images" class="test-class" data-values="" data-srcs=""></div>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Add More</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean All</button>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
