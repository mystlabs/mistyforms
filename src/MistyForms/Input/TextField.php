<?php

namespace MistyForms\Input;

class TextField extends Input
{
	public $value;
	public $minLength;
	public $maxLength;
	public $type;

	protected function initialize()
	{
		$this->value = $this->optionalAttribute( 'value', '' );
		$this->minLength = $this->optionalAttribute( 'minLength', -1 );
		$this->maxLength = $this->optionalAttribute( 'maxLength', -1 );
		$this->type = $this->optionalAttribute( 'type', 'text' );
	}

	public function fromView( array $params )
	{
		$this->value = self::readParam( $params, $this->name, null );
	}

	public function _fromRequest( array $request )
	{
		if( isset( $request[$this->id] ) )
		{
			$this->value = $request[$this->id];
		}
	}

	protected function _getData()
	{
		return $this->value;
	}

	public function validate()
	{
		if( $this->required && strlen( $this->value ) == 0 )
		{
			$this->errorMessage = "Questo campo è obbligatorio.";
			return false;
		}

		if( $this->minLength > 0 && strlen( $this->value ) < $this->minLength )
		{
			$this->errorMessage =  "Valore troppo corto. La lunghezza minima consentita è {$this->minLength} caratteri.";
			return false;
		}

		if( $this->maxLength > 0 && strlen( $this->value ) > $this->maxLength )
		{
			$this->errorMessage =  "Valore troppo lungo. La lunghezza massima consentita è {$this->maxLength} caratteri.";
			return false;
		}

		return true;
	}

	public function render()
	{
		return sprintf(
			'<input type="%s" name="%s" id="%s" value="%s"%s%s%s%s />',
			$this->type,
			$this->name,
			$this->id,
			$this->value,
			$this->stringifyClass(),
			$this->stringifyReadOnly(),
			$this->stringifyMaxLength(),
			$this->stringifyRemainingAttributes()
		);
	}

	protected function stringifyMaxLength()
	{
		if( !$this->readOnly ) return '';

		return " maxLength=\"{$this->maxLength}\"";
	}
}