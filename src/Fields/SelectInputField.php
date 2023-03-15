<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Options\HTMLFieldOptions;
use Pgly\FormFields\Sanitizers\HtmlSanitize;

/**
 * HTML select input field.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Fields
 * @version 1.0.0
 * @since 1.0.0
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
	 * @since 1.0.0
	 * @param HTMLFieldOptions $options
	 * @return void
	 */
	public function __construct(HTMLFieldOptions $options = null)
	{
		parent::__construct($options);
		$this->_options->changeType('select');
		$this->_options->sanitizeWith(new HtmlSanitize());
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param mixed $value
	 * @param array $options
	 * @since 1.0.0
	 * @return string
	 */
	public function render($value = '', array $options = []): string
	{
		$this->changeValue($value);

		$op = $this->_options;
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->onGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--select\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}
		$html .= "<select id=\"{$id}\" name=\"{$id}\" {$op->attrs()}>";

		if ($op->hasAttr('placeholder')) {
			$html .= "<option class=\"placeholder\" value=\"\">{$op->getAttr('placeholder')}</option>";
		}

		foreach ($options as $option) {
			$selected = $option['value'] === $vl ? 'selected="selected"' : '';
			$html .= "<option value=\"{$option['value']}\" {$selected}>{$option['label']}</option>";
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
