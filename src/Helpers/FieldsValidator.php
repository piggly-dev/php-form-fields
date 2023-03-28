<?php

namespace Pgly\FormFields\Helpers;

use Exception;
use Pgly\FormFields\Collections\FieldsCollection;
use Pgly\FormFields\Fields\AbstractHtmlInputField;
use Pgly\FormFields\Validators\NotEmptyValidator;

/**
 * HTML fields validator.
 *
 * @package \Pgly\FormFields
 * @subpackage \Pgly\FormFields\Helpers
 * @version 0.1.0
 * @since 0.1.0
 * @category Helpers
 * @author Caique Araujo <caique@piggly.com.br>
 * @author Piggly Lab <dev@piggly.com.br>
 * @license MIT
 * @copyright 2023 Piggly Lab <dev@piggly.com.br>
 */
class FieldsValidator
{
	/**
	 * Validate all fields.
	 *
	 * There are few options available, are they:
	 *
	 * 'schema' => [] // Its a wrapper of fields
	 * 'default' => null, // Default value for field
	 * 'allowed_values' => null, // An array with allowed values for field
	 * 'required' => true, // A boolean indication if field is required or not
	 * 'transform' => function ($v) { return $v; }, // A function to transform value to another
	 * 'validation' => [ function ($v) { throw new Exception(); }] // A bunch of functions that must throw error if value is unexpected
	 *
	 * @param array $raw Raw fields to validate. Eg.: [ 'field' => 'value' ].
	 * @param FieldsCollection $fields Fields.
	 * @param string $error_response Error response.
	 * @since 0.1.0
	 * @return array Validated fields. Eg.: [ 'field' => 'value' ].
	 * @throws Exception If any field is invalid.
	 */
	public static function validate(array $raw, FieldsCollection $fields, string $error_response = 'Não é possível validar, campos inválidos.'): array
	{
		$parsed  = [];

		try {
			foreach ($fields as $field) {
				/** @var AbstractHtmlInputField $field */
				$_value = ($raw[$field->options()->prefixedName()] ?? null);
				$_value = $field->options()->sanitize($_value);

				if ($field->options()->isAllowed($_value) === false) {
					$_value = $field->value();

					if (empty($_value)) {
						throw new Exception('Field must have allowed values.');
					}
				}

				if ($field->options()->getAttr('required', false) === true) {
					(new NotEmptyValidator())->validate($_value);
				}

				$field->options()->validate($_value);
				$parsed[$field->options()->prefixedName()] = $_value;
				$field->changeValue($_value);
			}//end foreach
		} catch (Exception $e) {
			throw new Exception($error_response, 0, $e);
		}//end try

		return $parsed;
	}
}
