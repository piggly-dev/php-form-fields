<?php

namespace Pgly\FormFields\Fields;

use InvalidArgumentException;
use Pgly\FormFields\Fields\RenderAttributes\ExtendedSelectRenderAttribute;
use Pgly\FormFields\Options\HtmlFieldOptions;
use Pgly\FormFields\Sanitizers\BooleanSanitize;

/**
 * HTML checkbox input field.
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
class ExtendedSelectInputField extends AbstractHtmlInputField
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
		$this->_options->changeType('eselect');
	}

	/**
	 * Render to HTML with value.
	 *
	 * @param ExtendedSelectRenderAttribute $render_attrs Attributes to render.
	 * @since 0.1.0
	 * @return string
	 * @throws InvalidArgumentException If $render_attrs is not ExtendedSelectRenderAttribute.
	 */
	public function render($render_attrs): string
	{
		if (($render_attrs instanceof ExtendedSelectRenderAttribute) === false) {
			throw new InvalidArgumentException('ExtendedSelectRenderAttribute expected on rendering.');
		}

		$this->changeValue($render_attrs->value());
		$lbl = $render_attrs->label();

		$op = $this->_options;
		$attrs = $op->attrs();

		$pl = $op->getAttr('placeholder', 'Selecione uma das opções');
		$id = $op->prefixedName();
		$vl = $this->value();
		$bs = $this->_cssBase;
		$fr = $op->isOnGroup() ? 'pgly-gform' : 'pgly-form';

		$html  = "<div class=\"{$bs}--column {$bs}-col--{$op->columnSize()}\">";
		$html .= "<div class=\"{$bs}--field {$fr}--input {$fr}--eselect\" data-name=\"{$op->name()}\">";

		if (!empty($op->label())) {
			$html .= "<label class=\"{$bs}--label\">{$op->label()}</label>";
		}

		$html .= "<div class=\"{$bs}--select\">";
		$html .= "<div id=\"{$id}\" class=\"selected empty\" data-value=\"{$vl}\" data-label=\"{$lbl}\" {$attrs}>";
		$html .= "<span>{$pl}</span>";
		$html .= "<svg class=\"{$bs}--arrow\" height=\"48\" viewBox=\"0 0 48 48\" width=\"48\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M14.83 16.42l9.17 9.17 9.17-9.17 2.83 2.83-12 12-12-12z\"></path><path d=\"M0-.75h48v48h-48z\" fill=\"none\"></path></svg>";
		$html .= "<svg class=\"{$bs}--spinner {$bs}-is-primary\" viewBox=\"0 0 50 50\"><circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle></svg>";
		$html .= '</div>';
		$html .= '<div class="items hidden">';
		$html .= "<div class=\"placeholder clickable\">{$pl}</div>";
		$html .= '<div class="container"></div>';
		$html .= '</div>';
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
