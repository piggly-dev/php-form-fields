<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to float.
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
class FloatSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to float.
	 *
	 * @param mixed $value
	 * @since 1.0.0
	 * @return string
	 */
	public function sanitize($value): string
	{
		return empty($value) ? null : \floatval($value);
	}
}
