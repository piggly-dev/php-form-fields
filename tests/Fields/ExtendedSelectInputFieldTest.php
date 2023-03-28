<?php

use Pgly\FormFields\Fields\ExtendedSelectInputField;
use Pgly\FormFields\Fields\RenderAttributes\ExtendedSelectRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class ExtendedSelectInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required', 'placeholder' => 'Test Placeholder']);

		$field = new ExtendedSelectInputField($options);

		$render_attrs = new ExtendedSelectRenderAttribute('one', 'Item One');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--12">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--eselect" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<div class="pgly-wps--select">';
		$expected_html .= '<div id="test_name" class="selected empty" data-value="one" data-label="Item One" class="test-class" required="required" placeholder="Test Placeholder">';
		$expected_html .= '<span>Test Placeholder</span>';
		$expected_html .= '<svg class="pgly-wps--arrow" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 16.42l9.17 9.17 9.17-9.17 2.83 2.83-12 12-12-12z"></path><path d="M0-.75h48v48h-48z" fill="none"></path></svg>';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-primary" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="items hidden">';
		$expected_html .= '<div class="placeholder clickable">Test Placeholder</div>';
		$expected_html .= '<div class="container"></div>';
		$expected_html .= '</div>';
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

		$field = new ExtendedSelectInputField($options);

		$render_attrs = new ExtendedSelectRenderAttribute(null, '');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--eselect" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<div class="pgly-wps--select">';
		$expected_html .= '<div id="test_name" class="selected empty" data-value="Test Value" data-label="" class="test-class" required="required">';
		$expected_html .= '<span>Selecione uma das opções</span>';
		$expected_html .= '<svg class="pgly-wps--arrow" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 16.42l9.17 9.17 9.17-9.17 2.83 2.83-12 12-12-12z"></path><path d="M0-.75h48v48h-48z" fill="none"></path></svg>';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-primary" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="items hidden">';
		$expected_html .= '<div class="placeholder clickable">Selecione uma das opções</div>';
		$expected_html .= '<div class="container"></div>';
		$expected_html .= '</div>';
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

		$field = new ExtendedSelectInputField($options);

		$render_attrs = new ExtendedSelectRenderAttribute('', '');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--eselect" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<div class="pgly-wps--select">';
		$expected_html .= '<div id="test_name" class="selected empty" data-value="" data-label="" class="test-class" required="required">';
		$expected_html .= '<span>Selecione uma das opções</span>';
		$expected_html .= '<svg class="pgly-wps--arrow" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 16.42l9.17 9.17 9.17-9.17 2.83 2.83-12 12-12-12z"></path><path d="M0-.75h48v48h-48z" fill="none"></path></svg>';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-primary" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="items hidden">';
		$expected_html .= '<div class="placeholder clickable">Selecione uma das opções</div>';
		$expected_html .= '<div class="container"></div>';
		$expected_html .= '</div>';
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

		$field = new ExtendedSelectInputField($options);

		$render_attrs = new ExtendedSelectRenderAttribute('', '');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--eselect" data-name="test_name">';

		$expected_html .= '<div class="pgly-wps--select">';
		$expected_html .= '<div id="test_name" class="selected empty" data-value="" data-label="" class="test-class">';
		$expected_html .= '<span>Selecione uma das opções</span>';
		$expected_html .= '<svg class="pgly-wps--arrow" height="48" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 16.42l9.17 9.17 9.17-9.17 2.83 2.83-12 12-12-12z"></path><path d="M0-.75h48v48h-48z" fill="none"></path></svg>';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-primary" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="items hidden">';
		$expected_html .= '<div class="placeholder clickable">Selecione uma das opções</div>';
		$expected_html .= '<div class="container"></div>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
