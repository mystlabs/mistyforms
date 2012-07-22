<?php

namespace MistyForms\Input;

class SelectBox extends Input
{
	public $options;
	public $selected;

	protected function initialize()
	{
		$this->options = self::parseOptions( $this->requiredAttribute( 'options' ) );
		$this->selected = $this->optionalAttribute( 'selected', null );
	}

	public function fromView( array $params )
	{
		$value = self::readParam( $params, $this->name, null );
		if( $value !== null )
		{
			$this->selected = $value;
		}
	}

	public function _fromRequest( array $request )
	{
		$this->selected = null;
		if( isset( $request[$this->id] ) )
		{
			$this->selected = $request[$this->id];
		}
	}

	public function _getData()
	{
		return $this->selected;
	}

	public function validate()
	{
		if( $this->required && ( $this->selected === null || $this->selected === '' ))
		{
			$this->errorMessage = "Devi selezionare una voce.";
			return false;
		}

		if( $this->selected && !self::isValidValue( $this->selected, $this->options ) )
		{
			$this->errorMessage = "Voce non valida.";
			return false;
		}

		return true;
	}

	public function render()
	{
		$options = array();
		foreach( $this->options as $option )
		{
			$options[] = sprintf(
				'<option value="%s"%s>%s</option>',
				$option['value'],
				$this->stringifySelected($option['value']),
				$option['text']
			);
		}

		return sprintf(
			'<select name="%s" id="%s"%s%s%s>%s</select>',
			$this->name,
			$this->id,
			$this->stringifyClass(),
			$this->stringifyReadOnly(),
			$this->stringifyRemainingAttributes(),
			implode("\n", $options)
		);
	}

	/**
	 * Add description - I'm already forgetting what this does!
	 */
	protected static function parseOptions( array $options )
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

	protected function stringifySelected($value)
	{
		if( $this->selected !== $value ) return '';

		return ' selected="selected"';
	}

	/**
	 * Check the user input against the original list of options
	 */
	protected static function isValidValue( $value, $options )
	{
		if( $value === null ) return false;

		foreach( $options as $option )
		{
			if( strval($option['value']) == $value )
			{
				return true;
			}
		}

		return false;
	}
}