<?php

namespace Mist\Form\Input;

use Mist\Http\Request;
use Mist\Presentation\View;

class RadioButton extends Input
{
	public $items;
	public $selected;
	
	protected function initialize()
	{
		$this->items = $this->requiredAttribute( 'items' );
		$this->selected = $this->optionalAttribute( 'selected', null );
	}
	
	public function fromView( array $params )
	{
		$this->selected = self::readParam( $params, $this->name, '' );
	}
	
	public function _fromRequest( Request $request )
	{
		$this->selected = $request->getPost( $this->name );
	}
	
	public function _assignData( &$result )
	{
		$result[$this->name] = $this->selected;
	}
	
	public function validate()
	{
		if( $this->required )
		{
			$found = false;
			foreach( $this->items as $item )
			{
				$found = $found || ( $item['value'] == $this->selected );
			}
			
			if( !$found )
			{
				$this->errorMessage = "Devi selezionare almeno un'opzione.";
				return false;
			}
		}
		
		return true;
	}
	
	public function render()
	{
		$type = " type=\"radio\"";
		$name = " name=\"". $this->name ."\"";
		$class = strlen( $this->class ) > 0 ? " class=\"". $this->class ."\"" : "";
		$readOnly = $this->readOnly ? " disabled=\"disabled\"" : "";
		
		$radiobuttons = '';
		foreach( $this->items as $key => $item )
		{
			$elementId = isset( $item['id'] ) ? $item['id'] : $this->id .'_rb_' . $key;
			$id = " id=\"". $elementId ."\"";
			$for = " for=\"{$elementId}\"";
			$checked = $item['value'] == $this->selected ? "checked=\"checked\"" : "";
			$value = " value=\"{$item['value']}\"";
			
			$radiobuttons .= "\n<input{$type}{$name}{$id}{$value}{$class}{$checked} />";
			$radiobuttons .= "\n<label{$for}>{$item['text']}</label><br />";
		}
		
		return "\n<div class='radiooptions'>$radiobuttons</div>";
	}
}