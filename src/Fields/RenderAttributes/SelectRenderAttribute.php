<?php

namespace Pgly\FormFields\Fields\RenderAttributes;

/**
 * Select render attributes.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Fields\RenderAttributes
 * @version 0.1.0
 * @since 0.1.0
 * @category Interfaces
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class SelectRenderAttribute extends BasicRenderAttribute
{
	/**
	 * Options to render.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $_options;

	/**
	 * Create a new render attribute.
	 *
	 * @param mixed $value Value to render.
	 * @param array $options Options to render. Eg.: ['value'=>'label'...].
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct($value, array $options)
	{
		$this->_value = $value;
		$this->_options = $options;
	}

	/**
	 * Get options to render.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	public function options(): array
	{
		return $this->_options;
	}
}
