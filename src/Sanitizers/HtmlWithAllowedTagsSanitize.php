<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to a valid HTML.
 * Works only on WordPress ecosystem.
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
class HtmlWithAllowedTagsSanitize implements SanitizableCallbackInterface
{
	/**
	 * Sanitize the value to a valid HTML.
	 * Works only on WordPress ecosystem.
	 *
	 * @param mixed $value Value to sanitize.
	 * @since 0.1.0
	 * @return string|null
	 */
	public function sanitize($value): ?string
	{
		if ($value === null) {
			return null;
		}

		return \wp_kses_post($value);
	}
}
