<?php

namespace Pgly\FormFields\Interfaces;

use Pgly\FormFields\Sanitizers\ArrayOfSanitize;
use Pgly\FormFields\Sanitizers\IntegerSanitize;
use Pgly\FormFields\Sanitizers\UrlSanitize;

/**
 * Extended multiple media render attributes.
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
class ExtendedMultipleMediaRenderAttribute extends BasicRenderAttribute
{
	/**
	 * Values to render.
	 *
	 * @since 0.1.0
	 * @var int[]
	 */
	protected $_value;

	/**
	 * SRC Url.
	 *
	 * @since 0.1.0
	 * @var string[]
	 */
	protected $_srcs;

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
	 * @param array $values Values to render. Eg.: [2, 3].
	 * @param array $srcs SRC Url array. Eg.: ['https://example.com/image-2.jpg', 'https://example.com/image-3.jpg'].
	 * @param array $labels Labels to render. Eg.: ['clean' => 'Clean All', 'select' => 'Add More'].
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct(array $values, array $srcs, array $labels = [])
	{
		$this->_value = (new ArrayOfSanitize(new IntegerSanitize()))->sanitize($values);
		$this->_srcs = (new ArrayOfSanitize(new UrlSanitize()))->sanitize($srcs);
		$this->_labels = \array_merge(['clean' => 'Clean All', 'select' => 'Add More'], $labels);
	}

	/**
	 * Get src to render.
	 *
	 * @since 0.1.0
	 * @return int[]
	 */
	public function value(): array
	{
		return $this->_value;
	}

	/**
	 * Get src to render.
	 *
	 * @since 0.1.0
	 * @return string[]
	 */
	public function srcs(): array
	{
		return $this->_srcs;
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
