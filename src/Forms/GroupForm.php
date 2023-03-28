<?php

namespace Pgly\FormFields\Forms;

use Pgly\FormFields\Collections\FieldsCollection;
use Pgly\FormFields\Options\HtmlGroupFormOptions;

/**
 * Group many input into a sub form.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Forms
 * @version 0.1.0
 * @since 0.1.0
 * @category Forms
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class GroupForm
{
	/**
	 * Fields collection.
	 *
	 * @var FieldsCollection
	 * @since 0.1.0
	 */
	protected $_fields;

	/**
	 * Form options.
	 *
	 * @since 0.1.0
	 * @var HtmlGroupFormOptions
	 */
	protected $_options;

	/**
	 * CSS base class.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_cssBase = 'pgly-wps';

	/**
	 * Create a new field.
	 *
	 * @since 0.1.0
	 * @param FieldsCollection $fields Form fields.
	 * @param HtmlGroupFormOptions $options Field options.
	 * @return void
	 */
	public function __construct(FieldsCollection $fields, HtmlGroupFormOptions $options = null)
	{
		if ($options === null) {
			$options = new HtmlGroupFormOptions();
		}

		$this->_options = $options;
		$this->_fields = $fields->toGroup();
	}

	/**
	 * Get group form options.
	 *
	 * @since 0.1.0
	 * @return HtmlGroupFormOptions
	 */
	public function options(): HtmlGroupFormOptions
	{
		return $this->_options;
	}

	/**
	 * Change CSS base class.
	 *
	 * @param string $base CSS base class.
	 * @since 0.1.0
	 * @return self
	 */
	public function changeCssBase(string $base)
	{
		$this->_cssBase = $base;
		return $this;
	}

	/**
	 * Get CSS base class.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function cssBase(): string
	{
		return $this->_cssBase;
	}

	/**
	 * Get fields collection.
	 *
	 * @since 0.1.0
	 * @return FieldsCollection
	 */
	public function fields(): FieldsCollection
	{
		return $this->_fields;
	}

	/**
	 * Render form header.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function renderHeader(): string
	{
		$bs = $this->_cssBase;
		$name = $this->_options->name();
		$attrs = $this->_options->getAttrs();

		$html = "<div class=\"{$bs}--column {$bs}-col--12\">";
		$html .= "<div class=\"{$bs}--group pgly-form--input pgly-form--group\" data-name=\"{$name}\" {$attrs}>";
		$html .= "<span class=\"{$bs}--message\"></span>";
		$html .= "<svg class=\"{$bs}--spinner {$bs}-is-primary\" viewBox=\"0 0 50 50\"><circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle></svg>";
		$html .= '<div class="container">';
		return $html;
	}

	/**
	 * Render form header.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function renderFooter(): string
	{
		$bs = $this->_cssBase;
		$submit_label = ($this->_options->labels()['submit'] ?? 'Add Data');
		$cancel_label = ($this->_options->labels()['cancel'] ?? 'Cancel');

		$html  = "<div class=\"{$bs}--row\"><div class=\"{$bs}--column\">";
		$html .= "<button class=\"{$bs}--button {$bs}-is-primary pgly-gform--submit\">{$submit_label}</button>";
		$html .= "<button class=\"{$bs}--button {$bs}-is-secondary pgly-gform--cancel\">{$cancel_label}</button>";
		$html .= '</div></div>';
		$html .= "<div class=\"{$bs}--row\"><div class=\"{$bs}--column {$bs}--items\"></div></div>";
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}
