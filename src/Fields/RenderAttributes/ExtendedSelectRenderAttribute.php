<?php

namespace Pgly\FormFields\Fields\RenderAttributes;

/**
 * Extended select render attributes.
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
class ExtendedSelectRenderAttribute extends BasicRenderAttribute
{
	/**
	 * Label to render.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_label;

	/**
	 * Create a new render attribute.
	 *
	 * @param mixed $value Value to render. Eg.: 2.
	 * @param string $label Label to render. Eg.: Option 2.
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct($value, string $label)
	{
		$this->_value = $value;
		$this->_label = $label;
	}

	/**
	 * Get label to render.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function label(): string
	{
		return $this->_label;
	}
}
