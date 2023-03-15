<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Options\HTMLFieldOptions;

/**
 * HTML textarea with no sanitizer input field.
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
class RawTextAreaInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('textarea');
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param mixed $value
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
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--textarea\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<textarea id=\"{$id}\" name=\"{$id}\" {$op->attrs()}>{$vl}</textarea>";

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

	/**
	 * Clean object after rendering when needed.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function clean()
	{
		$this->_options = null;
		$this->_value = null;
	}
}
