<?php

namespace Pgly\FormFields\Sanitizers;

use DateTime;
use DateTimeInterface;
use Exception;
use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to date time.
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
class DateTimeSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to date time.
	 *
	 * @param mixed $value Value to sanitize.
	 * @since 0.1.0
	 * @return string|null
	 */
	public function sanitize($value): ?string
	{
		if (empty($value)) {
			return null;
		}

		if ($value instanceof DateTimeInterface) {
			return $value->format('Y-m-d\TH:i');
		}

		try {
			return (new DateTime($value))->format('Y-m-d\TH:i');
		} catch (Exception $e) {
			return '0000-00-00T00:00';
		}
	}
}
