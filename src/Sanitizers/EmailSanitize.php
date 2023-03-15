<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to email.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Sanitizers
 * @version 1.0.0
 * @since 1.0.0
 * @category Sanitizers
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class EmailSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to email.
	 *
	 * @param mixed $value Value to sanitize.
	 * @since 1.0.0
	 * @return string
	 */
	public function sanitize($value): string
	{
		if (empty($value)) {
			return null;
		}

		return \filter_var($value, \FILTER_SANITIZE_EMAIL);
	}
}
