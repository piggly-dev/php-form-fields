<?php

namespace Pgly\FormFields\Fields;

use InvalidArgumentException;
use Pgly\FormFields\Fields\RenderAttributes\SelectRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\HtmlSanitize;

/**
 * HTML select input field.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Fields
 * @version 0.1.0
 * @since 0.1.0
 * @category Fields
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class SelectInputField extends AbstractHtmlInputField
{
	/**
	 * Create a new field.
	 *
	 * @since 0.1.0
	 * @param HtmlFieldOptions $options Field options.
	 * @return void
	 */
	public function __construct(HtmlFieldOptions $options = null)
	{
		parent::__construct($options);
		$this->_options->changeType('select');
		$this->_options->sanitizeWith(new HtmlSanitize());
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param SelectRenderAttribute $render_attrs Attributes to render.
	 * @since 0.1.0
	 * @return string
	 * @throws InvalidArgumentException If $render_attrs is not SelectRenderAttribute.
	 */
	public function render($render_attrs): string
	{
		if (($render_attrs instanceof SelectRenderAttribute) === false) {
			throw new InvalidArgumentException('SelectRenderAttribute expected on rendering.');
		}

		$this->changeValue($render_attrs->value());

		$op = $this->_options;
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->isOnGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--select\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}
		$html .= "<select id=\"{$id}\" name=\"{$id}\" {$op->attrs()}>";
		$html .= "<option class=\"placeholder\" value=\"\">{$op->getAttr('placeholder', 'Selecione uma das opções')}</option>";

		foreach ($render_attrs->options() as $value => $label) {
			$selected = '';

			if ($value === $vl) {
				$selected = 'selected="selected"';
			}

			$html .= "<option value=\"{$value}\" {$selected}>{$label}</option>";
		}

		$html .= '</select>';

		if ($op->hasAttr('required')) {
			$html .= "<span class=\"{$bs}--badge {$bs}-is-danger\" style=\"margin-top: 6px; margin-right: 6px\">{$this->_requiredLabel}</span>";
		}

		$html .= "<span class=\"{$bs}--message\"></span>";

		if (!empty($op->description())) {
			$html .= "<p class=\"{$bs}--description\">{$op->description()}</p>";
		}

		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}
