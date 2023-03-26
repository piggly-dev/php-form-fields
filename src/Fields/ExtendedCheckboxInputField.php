<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\BooleanSanitize;

/**
 * HTML checkbox input field.
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
class ExtendedCheckboxInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('checkbox');
		$this->_options->sanitizeWith(new BooleanSanitize());
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
		$attrs = $op->attrs();

		$pl = ($attrs['placeholder']??'');
		$id = $op->prefixedName();
		$vl = $this->value() ? 'true' : 'false';
		$bs = $this->_cssBase;
		$fr = $op->onGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--checkbox\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<div id=\"{$id}\" class=\"{$bs}--checkbox\" data-value=\"{$vl}\" {$attrs}>";
		$html .= '<div class="{$bs}--icon"></div>';
		$html .= "<div class=\"{$bs}--placeholder\">{$pl}</div>";
		$html .= '</div>';

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
