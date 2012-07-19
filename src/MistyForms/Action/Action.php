<?php

namespace MistyForms\Action;

use MistyForms\FormPlugin;

class Action extends FormPlugin
{
	public $id;
	public $name;
	public $text;
	
	public function __construct( array $attributes )
	{
		parent::__construct( $attributes );
		
		$this->id = $this->requiredAttribute( 'id' );
		$this->name = $this->optionalAttribute( 'name', $this->id );
		$this->text = $this->requiredAttribute( 'text' );
	}
	
	public function render()
	{
		$type = " type=\"submit\"";
		$name = " name=\"". $this->name ."\"";
		$id = " id=\"". $this->id ."\"";
		$class = strlen( $this->class ) > 0 ? " class=\"". $this->class ."\"" : "";
		$value = " value=\"". $this->text ."\"";
		$extras = $this->stringifyRemainingAttributes();
		
		return "<input{$type}{$name}{$id}{$class}{$value}{$extras} />";
	}
}