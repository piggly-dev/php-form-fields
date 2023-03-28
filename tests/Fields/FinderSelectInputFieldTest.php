<?php

use Pgly\FormFields\Fields\FinderSelectInputField;
use Pgly\FormFields\Fields\RenderAttributes\FinderSelectRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use PHPUnit\Framework\TestCase;

class FinderSelectInputFieldTest extends TestCase
{
	public function testRender()
	{
		$options = new HtmlFieldOptions();
		$options->changeName('test_name');
		$options->changeLabel('Test Label');
		$options->changeDescription('Test Description');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required', 'placeholder' => 'Test Placeholder']);

		$field = new FinderSelectInputField($options);

		$render_attrs = new FinderSelectRenderAttribute('one', 'Item One');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--12">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--finder" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<div class="pgly-wps--input flex-wrapper">';
		$expected_html .= '<input class="focus" placeholder="Test Placeholder" type="text">';
		$expected_html .= '<button class="pgly-wps--button pgly-async--behaviour pgly-wps-is-primary">';
		$expected_html .= 'Search';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</button>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="pgly-wps--selected pgly-wps--card pgly-wps-is-white pgly-wps-is-compact" style="display: none;" data-value="one" data-label="Item One">';
		$expected_html .= '<div class="pgly-wps--label inside left"></div>';
		$expected_html .= '<div class="pgly-wps--action-bar inside right">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger">Unselect</button>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';

		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Select</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean</button>';
		$expected_html .= '</div>';

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

		$field = new FinderSelectInputField($options);

		$render_attrs = new FinderSelectRenderAttribute(null, '');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--finder" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<div class="pgly-wps--input flex-wrapper">';
		$expected_html .= '<input class="focus" placeholder="Selecione um item" type="text">';
		$expected_html .= '<button class="pgly-wps--button pgly-async--behaviour pgly-wps-is-primary">';
		$expected_html .= 'Search';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</button>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="pgly-wps--selected pgly-wps--card pgly-wps-is-white pgly-wps-is-compact" style="display: none;" data-value="Test Value" data-label="">';
		$expected_html .= '<div class="pgly-wps--label inside left"></div>';
		$expected_html .= '<div class="pgly-wps--action-bar inside right">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger">Unselect</button>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';

		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Select</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean</button>';
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
		$options->changeDefaultValue('Test Value');
		$options->addAttrs(['class' => 'test-class', 'required' => 'required']);

		$field = new FinderSelectInputField($options);

		$render_attrs = new FinderSelectRenderAttribute('', '');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--finder" data-name="test_name">';
		$expected_html .= '<label class="pgly-wps--label">Test Label</label>';

		$expected_html .= '<div class="pgly-wps--input flex-wrapper">';
		$expected_html .= '<input class="focus" placeholder="Selecione um item" type="text">';
		$expected_html .= '<button class="pgly-wps--button pgly-async--behaviour pgly-wps-is-primary">';
		$expected_html .= 'Search';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</button>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="pgly-wps--selected pgly-wps--card pgly-wps-is-white pgly-wps-is-compact" style="display: none;" data-value="" data-label="">';
		$expected_html .= '<div class="pgly-wps--label inside left"></div>';
		$expected_html .= '<div class="pgly-wps--action-bar inside right">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger">Unselect</button>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$expected_html .= '<span class="pgly-wps--badge pgly-wps-is-danger" style="margin-top: 6px; margin-right: 6px">Obrigatório</span>';
		$expected_html .= '<span class="pgly-wps--message"></span>';
		$expected_html .= '<p class="pgly-wps--description">Test Description</p>';

		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Select</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean</button>';
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

		$field = new FinderSelectInputField($options);

		$render_attrs = new FinderSelectRenderAttribute('', '');
		$expected_html = '<div class="pgly-wps--column pgly-wps-col--6">';
		$expected_html .= '<div class="pgly-wps--field pgly-form--input pgly-form--finder" data-name="test_name">';

		$expected_html .= '<div class="pgly-wps--input flex-wrapper">';
		$expected_html .= '<input class="focus" placeholder="Selecione um item" type="text">';
		$expected_html .= '<button class="pgly-wps--button pgly-async--behaviour pgly-wps-is-primary">';
		$expected_html .= 'Search';
		$expected_html .= '<svg class="pgly-wps--spinner pgly-wps-is-white" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle></svg>';
		$expected_html .= '</button>';
		$expected_html .= '</div>';
		$expected_html .= '<div class="pgly-wps--selected pgly-wps--card pgly-wps-is-white pgly-wps-is-compact" style="display: none;" data-value="" data-label="">';
		$expected_html .= '<div class="pgly-wps--label inside left"></div>';
		$expected_html .= '<div class="pgly-wps--action-bar inside right">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger">Unselect</button>';
		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$expected_html .= '<span class="pgly-wps--message"></span>';

		$expected_html .= '<div class="pgly-wps--action-bar">';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-primary pgly-wps--select">Select</button>';
		$expected_html .= '<button class="pgly-wps--button pgly-wps-is-compact pgly-wps-is-danger pgly-wps--clean">Clean</button>';
		$expected_html .= '</div>';

		$expected_html .= '</div>';
		$expected_html .= '</div>';

		$this->assertEquals($expected_html, $field->render($render_attrs));
	}
}
