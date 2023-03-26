<?php

namespace Pgly\FormFields\Sanitizers;

use Pgly\FormFields\Interfaces\SanitizableCallbackInterface;

/**
 * Sanitize the value to boolean.
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
class ArrayOfSanitize implements SanitizableCallbackInterface
{
	/**
	 * Create a new sanitize class.
	 *
	 * @var SanitizableCallbackInterface
	 * @since 1.0.0
	 */
	protected $_sanitize;

	/**
	 * Create a new instance.
	 *
	 * @param SanitizableCallbackInterface $sanitize Create a new sanitizer.
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct(SanitizableCallbackInterface $sanitize)
	{
		$this->_sanitize = $sanitize;
	}

	/**
	 * Sanitize all values in array.
	 *
	 * @param array $value Value to sanitize.
	 * @since 1.0.0
	 * @return array
	 */
	public function sanitize($value): array
	{
		return \array_map(function ($v) {
			if (empty($value)) {
				return null;
			}

			return $this->_sanitize->sanitize($v);
		}, $value);
	}
}
