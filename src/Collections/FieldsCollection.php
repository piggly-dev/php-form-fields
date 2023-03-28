<?php

namespace Pgly\FormFields\Collections;

use Iterator;
use Pgly\FormFields\Fields\AbstractHtmlInputField;

/**
 * A collection of fields.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Collections
 * @version 0.1.0
 * @since 0.1.0
 * @category Helpers
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class FieldsCollection implements Iterator
{
	/**
	 * Form fields.
	 *
	 * @since 0.1.0
	 * @var AbstractHtmlInputField[]
	 */
	protected $_fields = [];

	/**
	 * Add a new field.
	 *
	 * @since 0.1.0
	 * @param AbstractHtmlInputField $field Field to add.
	 * @return self
	 */
	public function add(AbstractHtmlInputField $field)
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
	public function get(string $name)
	{
		foreach ($this->_fields as $field) {
			if ($field->options()->name() === $name) {
				return $field;
			}
		}

		return null;
	}

	/**
	 * Remove a field by name.
	 *
	 * @param string $name Field name.
	 * @since 0.1.0
	 * @return self
	 */
	public function remove(string $name)
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
	public function getAll()
	{
		return $this->_fields;
	}

	/**
	 * Apply to all fields as in group mode.
	 *
	 * @since 0.1.0
	 * @return self
	 */
	public function toGroup()
	{
		\array_map(function (AbstractHtmlInputField $field) {
			if ($field->options()->isOnGroup()) {
				return $field;
			}

			$_field = clone $field;
			$_field->options()->onGroup();
			return $_field;
		}, $this->_fields);

		return $this;
	}

	/**
	 * Render a field by name.
	 *
	 * @param string $name Field name.
	 * @param RenderAttributesInterface $render_attrs Attributes to render.
	 * @since 0.1.0
	 * @return string
	 */
	public function render(string $name, $render_attrs): string
	{
		$field = $this->get($name);

		if ($field === null) {
			return '';
		}

		return $field->render($render_attrs);
	}

	/**
	 * Render form fields solving it as rows and columns.
	 *
	 * @param RenderAttributesInterface[] $render_attrs Attributes to render. Eg.: ['label' => new BasicRenderAttribute()].
	 * @param string $css_base Base CSS class.
	 * @param int $max_column_size Max column size per row.
	 * @since 0.1.0
	 * @return string
	 */
	public function renderIntoRows(array $render_attrs, string $css_base = 'pgly-wps', int $max_column_size = 12): string
	{
		$rows = $this->organizeIntoRows($max_column_size);

		$html = '';

		foreach ($rows as $row) {
			$html .= "<div class=\"{$css_base}--row\">";

			foreach ($row as $field) {
				$html .= $field->render($render_attrs[$field->options()->name()]);
			}

			$html .= '</div>';
		}

		return $html;
	}

	/**
	 * Organize fields into rows.
	 *
	 * @param int $max_column_size Max column size per row.
	 * @since 0.1.0
	 * @return array
	 */
	public function organizeIntoRows(int $max_column_size = 12): array
	{
		$curr_colsize = 0;
		$rows = [];

		foreach ($this->_fields as $field) {
			$colsize = $field->options()->columnSize();

			if (($curr_colsize + $colsize) > $max_column_size) {
				$curr_colsize = 0;
			}

			if ($curr_colsize === 0) {
				$rows[] = [];
			}

			$rows[(count($rows) - 1)][] = $field;
			$curr_colsize += $colsize;
		}

		return $rows;
	}

	/**
	 * Rewind array.
	 *
	 * @return mixed
	 * @since 0.1.0
	 */
	public function rewind(): void
	{
		reset($this->_fields);
	}

	/**
	 * Current on array.
	 *
	 * @return mixed
	 * @since 0.1.0
	 */
	public function current()
	{
		return current($this->_fields);
	}

	/**
	 * Pointed to key at array.
	 *
	 * @return mixed
	 * @since 0.1.0
	 */
	public function key()
	{
		return key($this->_fields);
	}

	/**
	 * Next element on array.
	 *
	 * @return mixed
	 * @since 0.1.0
	 */
	public function next(): void
	{
		next($this->_fields);
	}

	/**
	 * Has curreny key on array.
	 *
	 * @return bool
	 * @since 0.1.0
	 */
	public function valid(): bool
	{
		return key($this->_fields) !== null;
	}
}
