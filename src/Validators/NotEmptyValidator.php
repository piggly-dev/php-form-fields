<?php

namespace Pgly\FormFields\Validators;

use Exception;
use Pgly\FormFields\Interfaces\ValidatableCallbackInterface;

/**
 * Validate a value throwning an exception if invalid.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Validators
 * @version 0.1.0
 * @since 0.1.0
 * @category Interfaces
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class NotEmptyValidator implements ValidatableCallbackInterface
{
	/**
	 * Validate a value throwning an exception if invalid.
	 *
	 * @since 0.1.0
	 * @param mixed $value Value to validate.
	 * @return void
	 * @throws Exception When value is invalid.
	 */
	public function validate($value)
	{
		if ($value === null || $value === '') {
			throw new Exception('Value cannot be empty.');
		}
	}
}
