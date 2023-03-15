<?php

namespace Pgly\FormFields\Interfaces;

/**
 * The renderable interface implements the render()
 * method to render object to HTML.
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
interface RenderableInterface
{
	/**
	 * Render to HTML with value.
	 *
	 * @param mixed $value Value to render.
	 * @since 1.0.0
	 * @return string
	 */
	public function render($value): string;

	/**
	 * Clean object after rendering when needed.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function clean();
}
