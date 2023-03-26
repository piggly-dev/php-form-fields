<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\ArrayOfSanitize;
use Pgly\FormFields\Sanitizers\BooleanSanitize;
use Pgly\FormFields\Sanitizers\IntegerSanitize;

/**
 * HTML multiple media input field.
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
class ExtendedMultipleMediaInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('multiple-media');
		$this->_options->sanitizeWith(new ArrayOfSanitize(new IntegerSanitize()));
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param array $value Field value.
	 * @param array $src Media source.
	 * @param array $labels Labels to clean and select.
	 * @since 1.0.0
	 * @return string
	 */
	public function render($value = [], $src = [], array $labels = []): string
	{
		$this->changeValue($value);
		$lbls = \array_merge(['clean' => 'Clean All', 'select' => 'Add More'], $labels);

		$op = $this->_options;
		$attrs = $op->attrs();

		$id = $op->prefixedName();
		$bs = $this->_cssBase;
		$fr = $op->onGroup() ? 'pgly-gform' : 'pgly-form';
		$vl = implode(',', $this->value());
		$srcs = implode(',', $src);

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$bs}--media-wrapper {$fr}--input {$fr}--multiple-media\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<div id=\"{$id}\" class=\"{$bs}--images\" {$attrs} data-values=\"{$vl}\" data-srcs=\"{$srcs}\"></div>";

		if ($op->hasAttr('required')) {
			$html .= "<span class=\"{$bs}--badge {$bs}-is-danger\" style=\"margin-top: 6px; margin-right: 6px\">{$this->_requiredLabel}</span>";
		}

		$html .= "<span class=\"{$bs}--message\"></span>";

		if (!empty($op->description())) {
			$html .= "<p class=\"{$bs}--description\">{$op->description()}</p>";
		}

		$html .= "<div class=\"{$bs}--action-bar\">
			<button class=\"{$bs}--button {$bs}-is-compact {$bs}-is-primary {$bs}--select\">{$lbls['select']}</button>
			<button class=\"{$bs}--button {$bs}-is-compact {$bs}-is-danger {$bs}--clean\">{$lbls['clean']}</button>
		</div>";

		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}
