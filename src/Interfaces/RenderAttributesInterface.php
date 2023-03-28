<?php

namespace Pgly\FormFields\Interfaces;

/**
 * Allow attributes for rendering.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Interfaces
 * @version 0.1.0
 * @since 0.1.0
 * @category Interfaces
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
interface RenderAttributesInterface
{
	/**
	 * Get value to render.
	 *
	 * @since 0.1.0
	 * @return mixed
	 */
	public function value();
}
