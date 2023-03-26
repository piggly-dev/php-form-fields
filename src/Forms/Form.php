<?php

namespace Pgly\FormFields\Forms;

use Pgly\FormFields\Fields\AbstractHtmlInputField;
use Pgly\FormFields\Interfaces\RenderAttributesInterface;
use Pgly\FormFields\Options\HtmlFormOptions;

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
	 * Form options.
	 *
	 * @since 0.1.0
	 * @var HtmlFormOptions
	 */
	protected $_options;

	/**
	 * Form fields.
	 *
	 * @since 0.1.0
	 * @var AbstractHtmlInputField[]
	 */
	protected $_fields = [];

	/**
	 * CSS base class.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_cssBase = '{$bs}';

	/**
	 * Create a new form.
	 *
	 * @param HtmlFormOptions $options Form options.
	 * @param AbstractHtmlInputField[] $fields Form fields.
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct(HtmlFormOptions $options = null, array $fields = [])
	{
		if ($options === null) {
			$options = new HtmlFormOptions();
		}

		$this->_options = $options;
		$this->_fields = $fields;
	}

	/**
	 * Add a new field.
	 *
	 * @since 0.1.0
	 * @param AbstractHtmlInputField $field Field to add.
	 * @return self
	 */
	public function addField(AbstractHtmlInputField $field)
	{
		$this->_fields[] = $field;
		return $this;
	}

	/**
	 * Get field by name
	 *
	 * @param string $name Field name.
	 * @since 0.1.0
	 * @return AbstractHtmlInputField|null
	 */
	public function getField(string $name)
	{
		foreach ($this->_fields as $field) {
			if ($field->options()->name() === $name) {
				return $field;
			}
		}

		return null;
	}

	/**
	 * Render a field by name.
	 *
	 * @param string $name Field name.
	 * @param RenderAttributesInterface $render_attrs Attributes to render.
	 * @since 0.1.0
	 * @return string
	 */
	public function renderField(string $name, $render_attrs): string
	{
		$field = $this->getField($name);

		if ($field === null) {
			return '';
		}

		return $field->render($render_attrs);
	}

	/**
	 * Remove a field by name.
	 *
	 * @param string $name Field name.
	 * @since 0.1.0
	 * @return self
	 */
	public function removeField(string $name)
	{
		foreach ($this->_fields as $key => $field) {
			if ($field->options()->name() === $name) {
				unset($this->_fields[$key]);
				return $this;
			}
		}

		return $this;
	}

	/**
	 * Get all fields.
	 *
	 * @since 0.1.0
	 * @return AbstractHtmlInputField[]
	 */
	public function getFields()
	{
		return $this->_fields;
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
		$attrs = $this->_options->getAttrs();
		$submit_label = ($this->_options->labels()['submit'] ?? 'Submit');

		$html  = "<form id=\"{$id}\" name=\"{$name}\" action=\"{$action}\" method=\"{$method}\" {$attrs}>";

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

		$html  = '<div class="{$bs}--row"><div class="{$bs}--column">';
		$html .= "<button class=\"{$bs}--button {$bs}-is-primary pgly-async--behaviour pgly-form--submit\">{$submit_label}<svg class=\"{$bs}--spinner {$bs}-is-white\" viewBox=\"0 0 50 50\"><circle class=\"path\" cx=\"25\" cy=\"25\" r=\"20\" fill=\"none\" stroke-width=\"5\"></circle></svg></button>";
		$html .= '</div></div>';
		$html .= '</form>';

		return $html;
	}
}
