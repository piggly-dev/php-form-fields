<?php

namespace Pgly\FormFields\Forms;

use InvalidArgumentException;
use Pgly\FormFields\Fields\AbstractHtmlInputField;
use Pgly\FormFields\Interfaces\GroupRenderAttribute;
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
	 * Form options.
	 *
	 * @since 0.1.0
	 * @var HtmlGroupFormOptions
	 */
	protected $_options;

	/**
	 * Group form fields.
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
	 * Create a new field.
	 *
	 * @since 0.1.0
	 * @param HtmlGroupFormOptions $options Field options.
	 * @param AbstractHtmlInputField[] $fields Field fields.
	 * @return void
	 */
	public function __construct(HtmlGroupFormOptions $options = null, array $fields = [])
	{
		if ($options === null) {
			$options = new HtmlGroupFormOptions();
		}

		$this->_options = $options;
		$this->_fields = \array_map(function (AbstractHtmlInputField $field) {
			if ($field->options()->onGroup()) {
				return $field;
			}

			$_field = clone $field;
			$_field->options()->onGroup(true);
			return $_field;
		}, $fields);
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
