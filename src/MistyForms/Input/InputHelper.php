<?php

namespace MistyForms\Input;

class InputHelper
{
	/**
	 * Add description - I'm already forgetting what this does!
	 */
	public static function parseOptions( array $options )
	{
		if( empty( $options ) ) return $options;

		// if options is already an array of arrays we assume it's also in the right format
		$firstKey = array_pop( array_keys( $options ) );
		if( is_array( $options[$firstKey] ) ) return $options;

		$parsedOptions = array();
		foreach( $options as $value => $text )
		{
			$parsedOptions[] = array(
				'value' => $value,
				'text' => $text
			);
		}

		return $parsedOptions;
	}

	/**
	 * Check the user input against the original list of options
	 */
	public static function isValidValue( $value, $options )
	{
		if( $value === null ) return false;

		foreach( $options as $option )
		{
			if( strval($option['value']) == strval($value) )
			{
				return true;
			}
		}

		return false;
	}
}