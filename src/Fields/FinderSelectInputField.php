<?php

namespace Pgly\FormFields\Fields;

use InvalidArgumentException;
use Pgly\FormFields\Fields\RenderAttributes\FinderSelectRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\ArrayOfSanitize;
use Pgly\FormFields\Sanitizers\IntegerSanitize;

/**
 * HTML finder media input field.
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
class FinderSelectInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('finder');
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param FinderSelectRenderAttribute $render_attrs Attributes to render.
	 * @since 0.1.0
	 * @return string
	 * @throws InvalidArgumentException If $render_attrs is not FinderSelectRenderAttribute.
	 */
	public function render($render_attrs): string
	{
		if (($render_attrs instanceof FinderSelectRenderAttribute) === false) {
			throw new InvalidArgumentException('FinderSelectRenderAttribute expected on rendering.');
		}

		$this->changeValue($render_attrs->value());
		$lbls = $render_attrs->labels();
		$lbl = $render_attrs->label();

		$op = $this->_options;
		$attrs = $op->attrs();

		$pl = ($attrs['placeholder']??'');
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->isOnGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$bs}--media-wrapper {$fr}--input {$fr}--finder\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<div class=\"{$bs}--input flex-wrapper\">
			<input class=\"focus\" placeholder=\"{$pl}\" type=\"text\">
			<button class=\"{$bs}--button pgly-async--behaviour {$bs}-is-primary\">
				{$lbls['search']}
				<svg class=\"{$bs}--spinner {$bs}-is-white\" viewBox=\"0 0 50 50\">
					<circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle>
				</svg>
			</button>
		</div>
		<div class=\"{$bs}--selected {$bs}--card {$bs}-is-white {$bs}-is-compact\"
			style=\"display: none;\" data-value=\"{$vl}\" data-label=\"{$lbl}\">
			<div class=\"{$bs}--label inside left\"></div>
			<div class=\"{$bs}--action-bar inside right\">
				<button class=\"{$bs}--button {$bs}-is-compact {$bs}-is-danger\">{$lbls['unselect']}</button>
			</div>
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
