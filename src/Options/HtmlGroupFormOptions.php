<?php

namespace Pgly\FormFields\Options;

use InvalidArgumentException;
use Pgly\FormFields\Options\Traits\HasAttrsTrait;

/**
 * Options to build an HTML form.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Options
 * @version 0.1.0
 * @since 0.1.0
 * @category Options
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class HtmlGroupFormOptions
{
	use HasAttrsTrait;

	/**
	 * Name.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_name;

	/**
	 * Labels.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $_labels = [
		'submit' => 'Add Data',
		'cancel' => 'Cancel'
	];

	/**
	 * Change name.
	 *
	 * @param string $name Name.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeName(string $name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
	 * Get name.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function name(): ?string
	{
		return $this->_name;
	}

	/**
	 * Change label.
	 *
	 * @param string $submit_button Label.
	 * @param string $cancel_button Label.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeLabels(string $submit_button, string $cancel_button)
	{
		$this->_labels = [
			'submit' => $submit_button,
			'cancel' => $cancel_button
		];

		return $this;
	}

	/**
	 * Get labels.
	 *
	 * submit => Submit button label.
	 *
	 * @return array
	 * @since 0.1.0
	 */
	public function labels(): array
	{
		return $this->_labels;
	}

	/**
	 * Create object. All options:
	 *
	 * name			string
	 * labels		array (submit => string (Submit button label), cancel => string (Cancel button label))
	 *
	 * @param array $options Options.
	 * @param array $attrs Attributes.
	 * @return HtmlGroupFormOptions
	 * @since 0.1.0
	 */
	public static function create(array $options, array $attrs = []): HtmlGroupFormOptions
	{
		$op = new HtmlGroupFormOptions();

		$strings = [
			'name' => 'changeName',
		];

		foreach ($strings as $value => $method) {
			if (isset($options[$value])) {
				$op->{$method}(\strval($options[$value]));
			}
		}

		if (isset($options['labels']) && \is_array($options['labels'])) {
			$op->_labels = $options['labels'];
		}

		if (!empty($attrs)) {
			$op->addAttrs($attrs);
		}

		return $op;
	}
}
