<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\HtmlSanitize;

/**
 * HTML text input field.
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
class TextInputField extends AbstractHtmlInputField
{
	/**
	 * Create a new field.
	 *
	 * @since 1.0.0
	 * @param HtmlFieldOptions $options Field options.
	 * @return void
	 */
	public function __construct(HtmlFieldOptions $options = null)
	{
		parent::__construct($options);
		$this->_options->changeType('text');
		$this->_options->sanitizeWith(new HtmlSanitize());
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param mixed $value Field value.
	 * @since 1.0.0
	 * @return string
	 */
	public function render($value = ''): string
	{
		$this->changeValue($value);

		$op = $this->_options;
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->onGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--text\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<input id=\"{$id}\" name=\"{$id}\" type=\"{$op->type()}\" value=\"{$vl}\" {$op->attrs()}>";

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
