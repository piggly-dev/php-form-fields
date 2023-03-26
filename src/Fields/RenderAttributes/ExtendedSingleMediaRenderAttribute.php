<?php

namespace Pgly\FormFields\Interfaces;

use Pgly\FormFields\Sanitizers\IntegerSanitize;
use Pgly\FormFields\Sanitizers\UrlSanitize;

/**
 * Extended single media render attributes.
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
class ExtendedSingleMediaRenderAttribute extends BasicRenderAttribute
{
	/**
	 * SRC Url.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_src;

	/**
	 * Labels to render.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $_labels;

	/**
	 * Create a new render attribute.
	 *
	 * @param integer $value Value to render. Eg.: 2.
	 * @param string $src SRC Url. Eg.: https://example.com/image.jpg.
	 * @param array $labels Labels to render. Eg.: ['clean' => 'Clean', 'select' => 'Select'].
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct(int $value, string $src, array $labels = [])
	{
		$this->_value = (new IntegerSanitize())->sanitize($value);
		$this->_src = (new UrlSanitize())->sanitize($src);
		$this->_labels = \array_merge(['clean' => 'Clean', 'select' => 'Select'], $labels);
	}

	/**
	 * Get value to render.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function value(): int
	{
		return $this->_value;
	}

	/**
	 * Get src to render.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function src(): string
	{
		return $this->_src;
	}

	/**
	 * Get labels to render.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	public function labels(): array
	{
		return $this->_labels;
	}
}
