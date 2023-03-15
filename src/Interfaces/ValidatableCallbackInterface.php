<?php

namespace Pgly\FormFields\Interfaces;

use Exception;

/**
 * Validate a value throwning an exception if invalid.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Interfaces
 * @version 1.0.0
 * @since 1.0.0
 * @category Interfaces
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
interface ValidatableCallbackInterface
{
	/**
	 * Validate a value throwning an exception if invalid.
	 *
	 * @since 1.0.0
	 * @param mixed $value
	 * @return void
	 * @throws Exception
	 */
	public function validate($value);
}
