<?php

namespace Pgly\FormFields\Sanitizers;

use DateTimeInterface;
use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to time.
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
class TimeSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to time.
	 *
	 * @param mixed $value
	 * @since 1.0.0
	 * @return string
	 */
	public function sanitize($value): string
	{
		if (empty($value)) {
			return null;
		}

		if ($value instanceof DateTimeInterface) {
			return $value->format('H:i');
		}

		return \htmlspecialchars($value);
	}
}
