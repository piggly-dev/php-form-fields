<?php

namespace Pgly\FormFields\Options;

use InvalidArgumentException;
use Pgly\FormFields\Options\Traits\HasAttrsTrait;
use Pgly\FormFields\Sanitizers\UrlSanitize;

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
class HtmlFormOptions
{
	use HasAttrsTrait;

	/**
	 * Render mode as form.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	public const RENDER_MODE_FORM = 'form';

	/**
	 * Render mode as div.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	public const RENDER_MODE_DIV = 'div';

	/**
	 * Name.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_name;

	/**
	 * Action page.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_action;

	/**
	 * Method.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected $_method;

	/**
	 * Labels.
	 *
	 * @since 0.1.0
	 * @var array
	 */
	protected $_labels = [
		'submit' => 'Submit'
	];

	/**
	 * Render mode.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected $_render_mode = 'form';

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
	 * @return self
	 * @since 0.1.0
	 */
	public function changeLabels(string $submit_button)
	{
		$this->_labels = [
			'submit' => $submit_button
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
	 * Change action.
	 *
	 * @param string $action action.
	 * @return self
	 * @since 0.1.0
	 */
	public function changeAction(string $action)
	{
		$this->_action = (new UrlSanitize())->sanitize($action);
		return $this;
	}

	/**
	 * Get action.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function action(): ?string
	{
		return $this->_action;
	}

	/**
	 * Change method value.
	 *
	 * @param string $method method value.
	 * @return self
	 * @throws InvalidArgumentException If method is invalid.
	 * @since 0.1.0
	 */
	public function changeMethod(string $method)
	{
		$method = \strtoupper($method);

		if (\in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'], true) === false) {
			throw new InvalidArgumentException('Invalid HTTP method.');
		}

		$this->_method = \strtoupper($method);
		return $this;
	}

	/**
	 * Get method value.
	 *
	 * @return mixed
	 * @since 0.1.0
	 */
	public function method()
	{
		return $this->_method;
	}

	/**
	 * Change render_mode.
	 *
	 * @param string $render_mode render_mode.
	 * @return self
	 * @throws InvalidArgumentException If render_mode is invalid.
	 * @since 0.1.0
	 */
	public function changeRenderMode(string $render_mode)
	{
		if (\in_array($render_mode, [self::RENDER_MODE_FORM, self::RENDER_MODE_DIV], true) === false) {
			throw new InvalidArgumentException('Invalid render mode.');
		}

		$this->_render_mode = \strtolower($render_mode);
		return $this;
	}

	/**
	 * Get render_mode.
	 *
	 * @return string|null
	 * @since 0.1.0
	 */
	public function renderMode(): ?string
	{
		return $this->_render_mode;
	}

	/**
	 * Create object. All options:
	 *
	 * name			string
	 * action		string
	 * method		string
	 * render_mode	string (form|div)
	 * labels		array (submit => string)
	 *
	 * @param array $options Options.
	 * @param array $attrs Attributes.
	 * @return HtmlFormOptions
	 * @since 0.1.0
	 */
	public static function create(array $options, array $attrs = []): HtmlFormOptions
	{
		$op = new HtmlFormOptions();

		$strings = [
			'name' => 'changeName',
			'action' => 'changeAction',
			'method' => 'changeMethod',
			'render_mode' => 'changeRenderMode',
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
