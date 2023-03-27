<?php

namespace Pgly\FormFields\Fields;

use InvalidArgumentException;
use Pgly\FormFields\Fields\RenderAttributes\ExtendedSingleMediaRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\ArrayOfSanitize;
use Pgly\FormFields\Sanitizers\BooleanSanitize;
use Pgly\FormFields\Sanitizers\IntegerSanitize;

/**
 * HTML multiple media input field.
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
class ExtendedSingleMediaInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('single-media');
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param ExtendedSingleMediaRenderAttribute $render_attrs Attributes to render.
	 * @since 0.1.0
	 * @return string
	 * @throws InvalidArgumentException If $render_attrs is not ExtendedSingleMediaRenderAttribute.
	 */
	public function render($render_attrs): string
	{
		if (($render_attrs instanceof ExtendedSingleMediaRenderAttribute) === false) {
			throw new InvalidArgumentException('ExtendedSingleMediaRenderAttribute expected on rendering.');
		}

		$this->changeValue($render_attrs->value());
		$lbls = $render_attrs->labels();

		$op = $this->_options;
		$attrs = $op->attrs();

		$pl = ($attrs['placeholder']??'');
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->isOnGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$bs}--media-wrapper {$fr}--input {$fr}--single-media\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<div id=\"{$id}\" class=\"container\" {$attrs}>
			<img data-value=\"{$vl}\" data-src=\"{$render_attrs->src()}\" />
			<span class=\"{$bs}--placeholder\">{$pl}</span>
		</div>";

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
