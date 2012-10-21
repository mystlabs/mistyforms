<?php

namespace MistyForms\Input;

class TextField extends Input
{
	public $value;
	public $minLength;
	public $maxLength;
	public $type;
    public $pattern;
    public $patternMessage;

	protected function initialize()
	{
		$this->value = $this->optionalAttribute( 'value', '' );
		$this->minLength = $this->optionalAttribute( 'minLength', -1 );
		$this->maxLength = $this->optionalAttribute( 'maxLength', -1 );
		$this->type = $this->optionalAttribute( 'type', 'text' );
		$this->pattern = $this->optionalAttribute( 'pattern', false );
        if ($this->pattern) {
            $this->patternMessage = $this->requiredAttribute( 'patternMessage' );
        }
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
			$this->errorMessage = "This field is required.";
			return false;
		}

		if( $this->minLength > 0 && strlen( $this->value ) < $this->minLength )
		{
			$this->errorMessage = sprintf(
				'Too short, minimum length is %d',
				$this->minLength
			);
			return false;
		}

		if( $this->maxLength > 0 && strlen( $this->value ) > $this->maxLength )
		{
			$this->errorMessage = sprintf(
				'Too long, maximum length is %d',
				$this->maxLength
			);
			return false;
		}

        if ($this->pattern && !preg_match("/{$this->pattern}/", $this->value)) {
            $this->errorMessage = $this->patternMessage;
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
