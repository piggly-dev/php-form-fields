<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Interfaces\RenderableInterface;
use Pgly\FormFields\Options\HTMLFieldOptions;

/**
 * HTML Input field.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Fields
 * @version 1.0.0
 * @since 1.0.0
 * @category Fields
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
abstract class AbstractHtmlInputField implements RenderableInterface
{
	/**
	 * Field options.
	 *
	 * @since 1.0.0
	 * @var HTMLFieldOptions
	 */
	protected $_options;

	/**
	 * Field value.
	 *
	 * @since 1.0.0
	 * @var mixed
	 */
	protected $_value;

	/**
	 * CSS base class.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected $_cssBase = 'pgly-wps';

	/**
	 * Required label.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected $_requiredLabel = 'Obrigatório';

	/**
	 * Create a new field.
	 *
	 * @since 1.0.0
	 * @param HTMLFieldOptions $options
	 * @return void
	 */
	public function __construct(HTMLFieldOptions $options = null)
	{
		$this->_options = \is_null($options) ? new HTMLFieldOptions() : $options;
	}

	/**
	 * Change field value.
	 *
	 * @param mixed $value
	 * @since 1.0.0
	 * @return self
	 */
	public function changeValue($value)
	{
		$this->_value = $this->_options->sanitize($value);
		return $this;
	}

	/**
	 * Get field value.
	 *
	 * @since 1.0.0
	 * @return mixed
	 */
	public function value()
	{
		return $this->_value ?? $this->_options->defaultValue() ?? '';
	}

	/**
	 * Change CSS base class.
	 *
	 * @param string $base
	 * @since 1.0.0
	 * @return self
	 */
	public function changeCssBase(string $base)
	{
		$this->_cssBase = $base;
		return $this;
	}

	/**
	 * Change required label.
	 *
	 * @param string $label
	 * @since 1.0.0
	 * @return self
	 */
	public function changeRequiredLabel(string $label)
	{
		$this->_requiredLabel = $label;
		return $this;
	}

	/**
	 * Get field options.
	 *
	 * @since 1.0.0
	 * @return HTMLFieldOptions
	 */
	public function options(): HTMLFieldOptions
	{
		return $this->_options;
	}

	/**
	 * Clean object after rendering when needed.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function clean()
	{
		$this->_options = null;
		$this->_value = null;
	}
}
