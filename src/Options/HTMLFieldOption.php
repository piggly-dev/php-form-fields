<?php

namespace Pgly\FormFields\Options;

use Exception;
use Pgly\FormFields\Interfaces\ParsableCallbackInterface;
use Pgly\FormFields\Interfaces\TransformableCallbackInterface;
use Pgly\FormFields\Interfaces\ValidatableCallbackInterface;

/**
 * Options to build an HTML field.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Options
 * @version 1.0.0
 * @since 1.0.0
 * @category Options
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class HTMLFieldOptions
{
	/**
	 * HTML Attributes.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	protected $_attrs = [
		'placeholder' => null,
		'required' => null,
	];

	/**
	 * Name.
	 *
	 * @since 1.0.0
	 * @var string|null
	 */
	protected $_name;

	/**
	 * Label.
	 *
	 * @since 1.0.0
	 * @var string|null
	 */
	protected $_label;

	/**
	 * Type.
	 *
	 * @since 1.0.0
	 * @var string|null
	 */
	protected $_type;

	/**
	 * Default value.
	 *
	 * @since 1.0.0
	 * @var mixed
	 */
	protected $_default;

	/**
	 * Description.
	 *
	 * @since 1.0.0
	 * @var string|null
	 */
	protected $_description;

	/**
	 * Prefix.
	 *
	 * @since 1.0.0
	 * @var string|null
	 */
	protected $_prefix;

	/**
	 * Allowed values.
	 *
	 * @since 1.0.0
	 * @var array|null
	 */
	protected $_allowed_values;

	/**
	 * Parse callbacks.
	 *
	 * @since 1.0.0
	 * @var ParsableCallbackInterface[]|null
	 */
	protected $_parse;

	/**
	 * Transform callbacks.
	 *
	 * @since 1.0.0
	 * @var TransformableCallbackInterface[]|null
	 */
	protected $_transform;

	/**
	 * Validation callbacks.
	 *
	 * @since 1.0.0
	 * @var ValidatableCallbackInterface[]|null
	 */
	protected $_validation;

	/**
	 * Column size.
	 *
	 * @since 1.0.0
	 * @var integer
	 */
	protected $_column_size = 12;

	/**
	 * Is on group?
	 *
	 * @since 1.0.0
	 * @var boolean
	 */
	protected $_on_group = false;

	/**
	 * Change name.
	 *
	 * @param string $name
	 * @return self
	 * @since 1.0.0
	 */
	public function changeName(string $name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
	 * Get name.
	 *
	 * @return string|null
	 * @since 1.0.0
	 */
	public function name(): ?string
	{
		return $this->_name;
	}

	/**
	 * Change label.
	 *
	 * @param string $label
	 * @return self
	 * @since 1.0.0
	 */
	public function changeLabel(string $label)
	{
		$this->_label = $label;
		return $this;
	}

	/**
	 * Get label.
	 *
	 * @return string|null
	 * @since 1.0.0
	 */
	public function label(): ?string
	{
		return $this->_label;
	}

	/**
	 * Change type.
	 *
	 * @param string $type
	 * @return self
	 * @since 1.0.0
	 */
	public function changeType(string $type)
	{
		$this->_type = $type;
		return $this;
	}

	/**
	 * Get type.
	 *
	 * @return string|null
	 * @since 1.0.0
	 */
	public function type(): ?string
	{
		return $this->_type;
	}

	/**
	 * Change default value.
	 *
	 * @param mixed $default
	 * @return self
	 * @since 1.0.0
	 */
	public function changeDefaultValue($default)
	{
		$this->_default = $default;
		return $this;
	}

	/**
	 * Get default value.
	 *
	 * @return mixed
	 * @since 1.0.0
	 */
	public function defaultValue()
	{
		return $this->_default;
	}

	/**
	 * Change description.
	 *
	 * @param string $description
	 * @return self
	 * @since 1.0.0
	 */
	public function changeDescription(string $description)
	{
		$this->_description = $description;
		return $this;
	}

	/**
	 * Get description.
	 *
	 * @return string|null
	 * @since 1.0.0
	 */
	public function description(): ?string
	{
		return $this->_description;
	}

	/**
	 * Change prefix.
	 *
	 * @param string $prefix
	 * @return self
	 * @since 1.0.0
	 */
	public function changePrefix(string $prefix)
	{
		$this->_prefix = $prefix;
		return $this;
	}

	/**
	 * Get prefix.
	 *
	 * @return string|null
	 * @since 1.0.0
	 */
	public function prefix(): ?string
	{
		return $this->_prefix;
	}

	/**
	 * Change allowed values.
	 *
	 * @param array $allowed_values
	 * @return self
	 * @since 1.0.0
	 */
	public function allowOnlyValues(array $allowed_values)
	{
		$this->_allowed_values = $allowed_values;
		return $this;
	}

	/**
	 * Check if value is allowed.
	 *
	 * @param mixed $value
	 * @return bool
	 * @since 1.0.0
	 */
	public function isAllowed($value): bool
	{
		return \is_null($this->_allowed_values) ? true : \in_array($value, $this->_allowed_values);
	}

	/**
	 * Apply parse callbacks.
	 *
	 * @param ParsableCallbackInterface[] $parse
	 * @return self
	 * @since 1.0.0
	 */
	public function parseWith(array $parse)
	{
		$this->_parse = $parse;
		return $this;
	}

	/**
	 * Parse value.
	 *
	 * @param mixed $value
	 * @return mixed
	 * @since 1.0.0
	 */
	public function parse($value)
	{
		if (empty($this->_parse)) {
			return $value;
		}

		foreach ($this->_parse as $parse) {
			$value = $parse->parse($value);
		}

		return $value;
	}

	/**
	 * Apply transform callbacks.
	 *
	 * @param TransformableCallbackInterface[] $transform
	 * @return self
	 * @since 1.0.0
	 */
	public function transformWith(array $transform)
	{
		$this->_transform = $transform;
		return $this;
	}

	/**
	 * Transform value.
	 *
	 * @param mixed $value
	 * @return mixed
	 * @since 1.0.0
	 */
	public function transform($value)
	{
		if (empty($this->_transform)) {
			return $value;
		}

		foreach ($this->_transform as $transform) {
			$value = $transform->transform($value);
		}

		return $value;
	}

	/**
	 * Apply validation callbacks.
	 *
	 * @param ValidatableCallbackInterface[] $validation
	 * @return self
	 * @since 1.0.0
	 */
	public function validateWith(array $validation)
	{
		$this->_validation = $validation;
		return $this;
	}

	/**
	 * Assert value.
	 *
	 * @param mixed $value
	 * @return bool
	 * @since 1.0.0
	 */
	public function assert($value)
	{
		try {
			$this->validate($value);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * Validate value.
	 *
	 * @param mixed $value
	 * @return void
	 * @since 1.0.0
	 */
	public function validate($value)
	{
		if (empty($this->_validation)) {
			return;
		}

		foreach ($this->_validation as $validation) {
			$validation->validate($value);
		}
	}

	/**
	 * Change column size.
	 *
	 * @param integer $column_size
	 * @return self
	 * @since 1.0.0
	 */
	public function changeColumnSize(int $column_size)
	{
		$this->_column_size = $column_size;
		return $this;
	}

	/**
	 * Mark it is on a group.
	 *
	 * @param boolean $on_group
	 * @return self
	 * @since 1.0.0
	 */
	public function onGroup()
	{
		$this->_on_group = true;
		return $this;
	}

	/**
	 * Mark it is not on a group.
	 *
	 * @param boolean $on_group
	 * @return self
	 * @since 1.0.0
	 */
	public function notOnGroup()
	{
		$this->_on_group = false;
		return $this;
	}

	/**
	 * Check if it is on a group.
	 *
	 * @return boolean
	 * @since 1.0.0
	 */
	public function isOnGroup(): bool
	{
		return $this->_on_group;
	}

	/**
	 * Add attribute.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return self
	 * @since 1.0.0
	 */
	public function addAttr(string $name, $value)
	{
		$this->_attrs[$name] = $value;
		return $this;
	}

	/**
	 * Add attributes.
	 *
	 * @param array $attrs
	 * @return self
	 * @since 1.0.0
	 */
	public function addAttrs(array $attrs)
	{
		$this->_attrs = \array_merge($this->_attrs, $attrs);
		return $this;
	}

	/**
	 * Append attribute.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return self
	 * @since 1.0.0
	 */
	public function appendAttr(string $name, $value)
	{
		if (!isset($this->_attrs[$name])) {
			$this->_attrs[$name] = $value;
			return $this;
		}

		if (\is_array($this->_attrs[$name])) {
			$this->_attrs[$name][] = $value;
			return $this;
		}

		$this->_attrs[$name] .= ' '.$value;
		return $this;
	}

	/**
	 * Append attributes.
	 *
	 * @param array $attrs
	 * @return self
	 * @since 1.0.0
	 */
	public function appendAttrs(array $attrs)
	{
		foreach ($attrs as $name => $value) {
			$this->appendAttr($name, $value);
		}

		return $this;
	}

	/**
	 * Remove attribute.
	 *
	 * @param string $name
	 * @return self
	 * @since 1.0.0
	 */
	public function removeAttr(string $name)
	{
		unset($this->_attrs[$name]);
		return $this;
	}

	/**
	 * Remove attributes.
	 *
	 * @param array $attrs
	 * @return self
	 * @since 1.0.0
	 */
	public function removeAttrs(array $attrs)
	{
		foreach ($attrs as $name) {
			$this->removeAttr($name);
		}

		return $this;
	}

	/**
	 * Get attribute.
	 *
	 * @param string $name
	 * @return mixed
	 * @since 1.0.0
	 */
	public function getAttr(string $name)
	{
		return $this->_attrs[$name] ?? null;
	}

	/**
	 * Get attributes.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function getAttrs(): array
	{
		return $this->_attrs;
	}

	/**
	 * Get attributes as long string.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function attrs(): string
	{
		$attrs = [];

		foreach ($this->_attrs as $name => $value) {
			if (\is_array($value)) {
				$value = \implode(' ', $value);
			}

			$attrs[] = $name.'="'.\htmlspecialchars($value).'"';
		}

		return \implode(' ', $attrs);
	}

	/**
	 * Create object.
	 *
	 * @param array $options
	 * @param array $attrs
	 * @return string
	 * @since 1.0.0
	 */
	public static function create(array $options, array $attrs = []): HTMLFieldOptions
	{
		$op = new HTMLFieldOptions();

		if (isset($options['name'])) {
			$op->changeName(\strval($options['name']));
		}

		if (isset($options['label'])) {
			$op->changeLabel(\strval($options['label']));
		}

		if (isset($options['description'])) {
			$op->changeDescription(\strval($options['description']));
		}

		if (isset($options['type'])) {
			$op->changeType(\strval($options['type']));
		}

		if (isset($options['default'])) {
			$op->changeDefaultValue($options['default']);
		}

		if (isset($options['prefix'])) {
			$op->changePrefix(\strval($options['prefix']));
		}

		if (isset($options['column_size'])) {
			$op->changeColumnSize(\intval($options['column_size']));
		}

		if (isset($options['on_group'])) {
			$op->_on_group = \boolval($options['on_group']);
		}

		if (isset($options['parse'])) {
			$op->parseWith($options['parse']);
		}

		if (isset($options['transform'])) {
			$op->transformWith($options['transform']);
		}

		if (isset($options['validation'])) {
			$op->validateWith($options['validation']);
		}

		if (!empty($attrs)) {
			$op->addAttrs($options['attrs']);
		}

		return $op;
	}
}
