<?php

namespace Pgly\FormFields\Interfaces;

/**
 * Sanitize a value.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Interfaces
 * @version 1.0.0
 * @since 1.0.0
 * @category Interfaces
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
interface SanitizableCallbackInterface
{
	/**
	 * Sanitize a value.
	 * Must return value.
	 *
	 * @since 1.0.0
	 * @param mixed $value
	 * @return mixed
	 */
	public function sanitize($value);
}
