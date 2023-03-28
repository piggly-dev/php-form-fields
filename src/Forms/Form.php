<?php

namespace Pgly\FormFields\Forms;

use Pgly\FormFields\Collections\FieldsCollection;
use Pgly\FormFields\Options\HtmlFormOptions;
use Pgly\FormFields\Options\HtmlGroupFormOptions;

/**
 * HTML form.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Options
 * @version 0.1.0
 * @since 0.1.0
 * @category Options
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class Form
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
	 * @var HtmlFormOptions
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
	 * Create a new form.
	 *
	 * @param FieldsCollection $fields Form fields.
	 * @param HtmlFormOptions $options Form options.
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct(FieldsCollection $fields, HtmlFormOptions $options = null)
	{
		if ($options === null) {
			$options = new HtmlFormOptions();
		}

		$this->_options = $options;
		$this->_fields = $fields;
	}

	/**
	 * Get form options.
	 *
	 * @since 0.1.0
	 * @return HtmlFormOptions
	 */
	public function options(): HtmlFormOptions
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
	 * Convert form to a group from.
	 *
	 * @param HtmlGroupFormOptions $options Group options.
	 * @since 0.1.0
	 * @return GroupForm
	 */
	public function toGroup(HtmlGroupFormOptions $options): GroupForm
	{
		return new GroupForm($this->_fields, $options);
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
		$id = $this->_options->getAttr('id', $this->_options->name());
		$name = $this->_options->name();
		$action = $this->_options->action();
		$method = $this->_options->method();
		$attrs = $this->_options->attrs();
		$submit_label = ($this->_options->labels()['submit'] ?? 'Submit');
		$formWrapper = $this->_options->renderMode();

		$html  = "<{$formWrapper} id=\"{$id}\" name=\"{$name}\" action=\"{$action}\" method=\"{$method}\" {$attrs}>";

		$html .= "<div class=\"{$bs}--row\"><div class=\"{$bs}--column\">";
		$html .= "<button class=\"{$bs}--button {$bs}-is-primary pgly-async--behaviour pgly-form--submit\">{$submit_label}<svg class=\"{$bs}--spinner {$bs}-is-white\" viewBox=\"0 0 50 50\"><circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle></svg></button>";
		$html .= '</div></div>';

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
		$submit_label = ($this->_options->labels()['submit'] ?? 'Submit');
		$formWrapper = $this->_options->renderMode();

		$html  = "<div class=\"{$bs}--row\"><div class=\"{$bs}--column\">";
		$html .= "<button class=\"{$bs}--button {$bs}-is-primary pgly-async--behaviour pgly-form--submit\">{$submit_label}<svg class=\"{$bs}--spinner {$bs}-is-white\" viewBox=\"0 0 50 50\"><circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle></svg></button>";
		$html .= '</div></div>';
		$html .= "</{$formWrapper}>";

		return $html;
	}
}
