<?php

namespace MistyForms\Input;

class CheckBox extends Input
{
	public $checked;

	protected function initialize()
	{
		$this->checked = (bool)$this->optionalAttribute( 'checked', '' );
	}

	public function fromView( array $params )
	{
		$this->checked = (bool)self::readParam( $params, $this->name, $this->checked );
	}

	public function _fromRequest( array $request )
	{
		if( isset( $request[$this->id] ) )
		{
			$this->checked = (bool)$request[$this->id];
		}
	}

	protected function _getData()
	{
		return $this->checked;
	}

	public function validate()
	{
		if( $this->required && !$this->checked )
		{
			$this->errorMessage = "Questo campo è obbligatorio.";
			return false;
		}

		return true;
	}

	public function render()
	{
		$type = " type=\"checkbox\"";
		$name = " name=\"". $this->name ."\"";
		$id = " id=\"". $this->id ."\"";
		$class = strlen( $this->class ) > 0 ? " class=\"". $this->class ."\"" : "";
		$checked = $this->checked ? " checked=\"checked\"" : "";
		$readOnly = $this->readOnly ? " readonly=\"readonly\"" : "";
		$extras = $this->stringifyRemainingAttributes();

		return "<input{$type}{$name}{$id}{$class}{$checked}{$readOnly}{$extras} />";
	}
}