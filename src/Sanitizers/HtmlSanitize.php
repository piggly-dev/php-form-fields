<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize all HTML values to special chars.
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
class HtmlSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize all HTML values to special chars.
	 *
	 * @param mixed $value Value to sanitize.
	 * @since 0.1.0
	 * @return string|null
	 */
	public function sanitize($value): ?string
	{
		return empty($value) ? null : \htmlspecialchars($value);
	}
}
