<?php

namespace Pgly\FormFields\Options;

use Exception;
use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;
use Pgly\FormFields\Interfaces\ValidatableCallbackInterface;
use Pgly\FormFields\Options\Traits\HasAttrsTrait;

/**
 * Options to build an HTML field.
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
class HtmlFieldOptions
{
	use HasAttrsTrait;

	/**
	 * Name.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_name;

	/**
	 * Label.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_label;

	/**
	 * Type.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_type;

	/**
	 * Default value.
	 *
	 * @since 0.1.0
	 * @var mixed
	 */
	protected $_default;

	/**
	 * Description.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_description;

	/**
	 * Prefix.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_prefix;

	/**
	 * Allowed values.
	 *
	 * @since 0.1.0
	 * @var array|null
	 */
	protected $_allowed_values;

	/**
	 * Sanitizing callbacks.
	 *
	 * @since 0.1.0
	 * @var SanitizableCallbackInterface[]|null
	 */
	protected $_sanitizing;

	/**
	 * Validation callbacks.
	 *
	 * @since 0.1.0
	 * @var ValidatableCallbackInterface[]|null
	 */
	protected $_validation;

	/**
	 * Column size.
	 *
	 * @since 0.1.0
	 * @var integer
	 */
	protected $_column_size = 12;

	/**
	 * Is on group?
	 *
	 * @since 0.1.0
	 * @var boolean
	 */
	protected $_on_group = false;

	/**
	 * Change name.
	 *
	 * @param string $name Name.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeName(string $name)
	{
		$this->_name = \htmlspecialchars($name);
		return $this;
	}

	/**
	 * Get name.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function name(): ?string
	{
		return $this->_name;
	}

	/**
	 * Change label.
	 *
	 * @param string $label Label.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeLabel(string $label)
	{
		$this->_label = \htmlspecialchars($label);
		return $this;
	}

	/**
	 * Get label.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function label(): ?string
	{
		return $this->_label;
	}

	/**
	 * Change type.
	 *
	 * @param string $type Type.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeType(string $type)
	{
		$this->_type = \htmlspecialchars($type);
		return $this;
	}

	/**
	 * Get type.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function type(): ?string
	{
		return $this->_type;
	}

	/**
	 * Change default value.
	 *
	 * @param mixed $default Default value.
	 * @return self
	 * @since 0.1.0
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
	 * @since 0.1.0
	 */
	public function defaultValue()
	{
		return $this->_default;
	}

	/**
	 * Change description.
	 *
	 * @param string $description Description.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeDescription(string $description)
	{
		$this->_description = \htmlspecialchars($description);
		return $this;
	}

	/**
	 * Get description.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function description(): ?string
	{
		return $this->_description;
	}

	/**
	 * Change prefix.
	 *
	 * @param string $prefix Prefix.
	 * @return self
	 * @since 0.1.0
	 */
	public function changePrefix(string $prefix)
	{
		$this->_prefix = \htmlspecialchars($prefix);
		return $this;
	}

	/**
	 * Get prefix.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function prefix(): ?string
	{
		return $this->_prefix;
	}

	/**
	 * Get prefixed name.
	 *
	 * @param string $separator Separator.
	 * @return string|null
	 * @since 0.1.0
	 */
	public function prefixedName($separator = '_'): ?string
	{
		if ($this->_prefix === null) {
			return $this->_name;
		}

		return $this->_prefix . $separator . $this->_name;
	}

	/**
	 * Change allowed values.
	 *
	 * @param array $allowed_values Allowed values.
	 * @return self
	 * @since 0.1.0
	 */
	public function allowOnlyValues(array $allowed_values)
	{
		$this->_allowed_values = $allowed_values;
		return $this;
	}

	/**
	 * Check if value is allowed.
	 *
	 * @param mixed $value Value to check.
	 * @return bool
	 * @since 0.1.0
	 */
	public function isAllowed($value): bool
	{
		return ($this->_allowed_values === null) ? true : \in_array($value, $this->_allowed_values, true);
	}

	/**
	 * Apply sanitizing callbacks.
	 *
	 * @param SanitizableCallbackInterface ...$sanitize Sanitizing callbacks.
	 * @return self
	 * @since 0.1.0
	 */
	public function sanitizeWith(...$sanitize)
	{
		if (empty($this->_sanitizing)) {
			$this->_sanitizing = $sanitize;
			return $this;
		}

		$this->_sanitizing = \array_merge($this->_sanitizing, $sanitize);
		return $this;
	}

	/**
	 * Clean sanitizing callbacks.
	 *
	 * @return self
	 * @since 0.1.0
	 */
	public function cleanSanitizers()
	{
		$this->_sanitizing = [];
		return $this;
	}

	/**
	 * Sanitize value.
	 *
	 * @param mixed $value Value to sanitize.
	 * @return mixed
	 * @since 0.1.0
	 */
	public function sanitize($value)
	{
		if (empty($this->_sanitizing)) {
			return $value;
		}

		foreach ($this->_sanitizing as $s) {
			$value = $s->sanitize($value);
		}

		return $value;
	}

	/**
	 * Apply validation callbacks.
	 *
	 * @param ValidatableCallbackInterface[] ...$validation Validation callbacks.
	 * @return self
	 * @since 0.1.0
	 */
	public function validateWith(...$validation)
	{
		if (empty($this->_validation)) {
			$this->_validation = $validation;
			return $this;
		}

		$this->_validation = \array_merge($this->_validation, $validation);
		return $this;
	}

	/**
	 * Assert value.
	 *
	 * @param mixed $value Value to assert.
	 * @return bool
	 * @since 0.1.0
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
	 * @param mixed $value Value to validate.
	 * @return void
	 * @since 0.1.0
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
	 * Clean validations callbacks.
	 *
	 * @return self
	 * @since 0.1.0
	 */
	public function cleanValidations()
	{
		$this->_validation = [];
		return $this;
	}

	/**
	 * Change column size.
	 *
	 * @param integer $column_size Column size.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeColumnSize(int $column_size)
	{
		$this->_column_size = $column_size;
		return $this;
	}

	/**
	 * Get column size.
	 *
	 * @return integer
	 * @since 0.1.0
	 */
	public function columnSize(): int
	{
		return $this->_column_size;
	}

	/**
	 * Mark it is on a group.
	 *
	 * @return self
	 * @since 0.1.0
	 */
	public function onGroup()
	{
		$this->_on_group = true;
		return $this;
	}

	/**
	 * Mark it is not on a group.
	 *
	 * @return self
	 * @since 0.1.0
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
	 * @since 0.1.0
	 */
	public function isOnGroup(): bool
	{
		return $this->_on_group;
	}

	/**
	 * Create object. All options:
	 *
	 * name			string
	 * label			string
	 * description	string
	 * type			string
	 * default		mixed
	 * prefix		string
	 * column_size	integer
	 * on_group		boolean
	 * sanitize		SanitizableCallbackInterface[]
	 * validation	ValidatableCallbackInterface[]
	 *
	 * @param array $options Options.
	 * @param array $attrs Attributes.
	 * @return HtmlFieldOptions
	 * @since 0.1.0
	 */
	public static function create(array $options, array $attrs = []): HtmlFieldOptions
	{
		$op = new HtmlFieldOptions();

		$strings = [
			'name' => 'changeName',
			'label' => 'changeLabel',
			'description' => 'changeDescription',
			'type' => 'changeType',
			'prefix' => 'changePrefix',
		];

		foreach ($strings as $value => $method) {
			if (isset($options[$value])) {
				$op->{$method}(\strval($options[$value]));
			}
		}

		if (isset($options['default'])) {
			$op->changeDefaultValue($options['default']);
		}

		if (isset($options['column_size'])) {
			$op->changeColumnSize(\intval($options['column_size']));
		}

		if (isset($options['on_group'])) {
			$op->_on_group = \boolval($options['on_group']);
		}

		if (isset($options['sanitize'])) {
			$op->sanitizeWith($options['sanitize']);
		}

		if (isset($options['validation'])) {
			$op->validateWith($options['validation']);
		}

		if (!empty($attrs)) {
			$op->addAttrs($attrs);
		}

		return $op;
	}
}
