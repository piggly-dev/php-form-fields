<?php

namespace Pgly\FormFields\Options\Traits;

/**
 * Option has attributes.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Options\Traits
 * @version 0.1.0
 * @since 0.1.0
 * @category Traits
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
trait HasAttrsTrait
{
	/**
	 * HTML Attributes.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $_attrs = [];

	/**
	 * Add attribute.
	 *
	 * @param string $name Attribute name.
	 * @param mixed $value Attribute value.
	 * @return self
	 * @since 0.1.0
	 */
	public function addAttr(string $name, $value)
	{
		$this->_attrs[$name] = ($value);
		return $this;
	}

	/**
	 * Add attributes.
	 *
	 * @param array $attrs Attributes. Eg.: ['name' => 'value', 'name2' => 'value2'].
	 * @return self
	 * @since 0.1.0
	 */
	public function addAttrs(array $attrs)
	{
		$this->_attrs = \array_merge($this->_attrs, $attrs);
		return $this;
	}

	/**
	 * Append attribute.
	 *
	 * @param string $name Attribute name.
	 * @param mixed $value Attribute value.
	 * @return self
	 * @since 0.1.0
	 */
	public function appendAttr(string $name, $value)
	{
		if (!isset($this->_attrs[$name])) {
			$this->_attrs[$name] = ($value);
			return $this;
		}

		if (\is_array($this->_attrs[$name])) {
			$this->_attrs[$name][] = ($value);
			return $this;
		}

		$this->_attrs[$name] .= ' ' . ($value);
		return $this;
	}

	/**
	 * Append attributes.
	 *
	 * @param array $attrs  Attribute name and value. Eg.: name => value.
	 * @return self
	 * @since 0.1.0
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
	 * @param string $name  Attribute name.
	 * @return self
	 * @since 0.1.0
	 */
	public function removeAttr(string $name)
	{
		unset($this->_attrs[$name]);
		return $this;
	}

	/**
	 * Remove attributes.
	 *
	 * @param array $attrs Attribute names.
	 * @return self
	 * @since 0.1.0
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
	 * @param string $name Attribute name.
	 * @param mixed $default Default value.
	 * @return mixed
	 * @since 0.1.0
	 */
	public function getAttr(string $name, $default = null)
	{
		return ($this->_attrs[$name] ?? $default);
	}

	/**
	 * Get attributes.
	 *
	 * @return array
	 * @since 0.1.0
	 */
	public function getAttrs(): array
	{
		return $this->_attrs;
	}

	/**
	 * Check if attribute exists.
	 *
	 * @param string $name Attribute name.
	 * @return boolean
	 * @since 0.1.0
	 */
	public function hasAttr(string $name): bool
	{
		return isset($this->_attrs[$name]) && !empty($this->_attrs[$name]);
	}

	/**
	 * Get attributes as long string.
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function attrs(): string
	{
		$attrs = [];

		foreach ($this->_attrs as $name => $value) {
			if (\is_array($value)) {
				$value = \implode(' ', $value);
			}

			$attrs[] = \sprintf('%s="%s"', $name, \htmlspecialchars($value));
		}

		return \implode(' ', $attrs);
	}
}
