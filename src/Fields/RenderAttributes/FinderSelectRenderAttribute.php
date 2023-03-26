<?php

namespace Pgly\FormFields\Interfaces;

/**
 * Finder select render attributes.
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
class FinderSelectRenderAttribute extends BasicRenderAttribute
{
	/**
	 * Label to render.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_label;

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
	 * @param mixed $value Value to render. Eg.: 2.
	 * @param string $label Label to render. Eg.: Option 2.
	 * @param array $labels Labels to render. Eg.: ['search' => 'Search', 'unselect' => 'Unselect'].
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct($value, string $label, array $labels = [])
	{
		$this->_value = $value;
		$this->_label = $label;
		$this->_labels = \array_merge(['search' => 'Search', 'unselect' => 'Unselect'], $labels);
	}

	/**
	 * Get label to render.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	public function label(): string
	{
		return $this->_label;
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
