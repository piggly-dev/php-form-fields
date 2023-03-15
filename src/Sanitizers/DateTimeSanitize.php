<?php

namespace Pgly\FormFields\Sanitizers;

use DateTimeInterface;
use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to date time.
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
class DateTimeSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to date time.
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

		if ($value instanceof DateTimeInterface) {
			return $value->format('Y-m-d\TH:i');
		}

		return \htmlspecialchars($value);
	}
}
