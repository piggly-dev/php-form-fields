<?php

namespace Pgly\FormFields\Interfaces;

/**
 * Basic render attributes.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Interfaces
 * @version 0.1.0
 * @since 0.1.0
 * @category Interfaces
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class BasicRenderAttribute implements RenderAttributesInterface
{
	/**
	 * Value to render.
	 *
	 * @since 0.1.0
	 * @var mixed
	 */
	protected $_value;

	/**
	 * Create a new render attribute.
	 *
	 * @param mixed $value Value to render.
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct($value)
	{
		$this->_value = $value;
	}

	/**
	 * Get value to render.
	 *
	 * @since 0.1.0
	 * @return mixed
	 */
	public function value()
	{
		return $this->_value;
	}
}
