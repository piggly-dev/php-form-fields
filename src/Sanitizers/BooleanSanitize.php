<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to boolean.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Sanitizers
 * @version 0.1.0
 * @since 0.1.0
 * @category Sanitizers
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class BooleanSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to float.
	 *
	 * @param mixed $value Value to sanitize.
	 * @since 0.1.0
	 * @return bool
	 */
	public function sanitize($value): bool
	{
		if ($value === 'on' || $value === 'true' || $value === '1') {
			return true;
		}

		if ($value === 'off' || $value === 'false' || $value === '0') {
			return false;
		}

		return \boolval(($value ?? false));
	}
}
