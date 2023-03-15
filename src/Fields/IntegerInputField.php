<?php

namespace Pgly\FormFields\Fields;

use Pgly\FormFields\Options\HTMLFieldOptions;
use Pgly\FormFields\Sanitizers\IntegerSanitize;

/**
 * HTML integer input field.
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
class IntegerInputField extends TextInputField
{
	/**
	 * Create a new field.
	 *
	 * @since 1.0.0
	 * @param HTMLFieldOptions $options
	 * @return void
	 */
	public function __construct(HTMLFieldOptions $options = null)
	{
		parent::__construct($options);
		$this->_options->changeType('number');
		$this->_options->sanitizeWith(new IntegerSanitize());
	}
}