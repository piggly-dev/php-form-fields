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
class ExtendedSelectInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('eselect');
		$this->_options->sanitizeWith(new BooleanSanitize());
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param string $value Field value.
	 * @param string $lbl Label to field.
	 * @since 1.0.0
	 * @return string
	 */
	public function render($value = '', $lbl = ''): string
	{
		$this->changeValue($value);

		$op = $this->_options;
		$attrs = $op->attrs();

		$pl = ($attrs['placeholder']??'');
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->onGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--eselect\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<div class=\"{$bs}--select\">
			<div id=\"{$id}\" class=\"selected empty\" data-value=\"{$vl}\" data-label=\"{$lbl}\" {$attrs}>
				<span>{$pl}</span>
				<svg class=\"{$bs}--arrow\" height=\"48\" viewBox=\"0 0 48 48\" width=\"48\"
					xmlns=\"http://www.w3.org/2000/svg\">
					<path d=\"M14.83 16.42l9.17 9.17 9.17-9.17 2.83 2.83-12 12-12-12z\"></path>
					<path d=\"M0-.75h48v48h-48z\" fill=\"none\"></path>
				</svg>
				<svg class=\"{$bs}--spinner {$bs}-is-primary\" viewBox=\"0 0 50 50\">
					<circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle>
				</svg>
			</div>
			<div class=\"items hidden\">
				<div class=\"placeholder clickable\">{$pl}</div>
				<div class=\"container\"></div>
			</div>
		</div>";

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
