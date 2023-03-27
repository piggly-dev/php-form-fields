<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to float.
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
class FloatSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to float.
	 *
	 * @param mixed $value Value to sanitize.
	 * @since 0.1.0
	 * @return float|null
	 */
	public function sanitize($value): ?float
	{
		return (empty($value) && $value !== 0) ? null : \floatval($value);
	}
}
