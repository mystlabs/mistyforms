<?php

namespace Mist\Form\Label;

use Mist\Form\Input\Input;

class SimpleLabel extends Label
{
	public function initialize()
	{
		$this->optionalAttribute( 'for' );
	}

	public function render()
	{

		$for = " for=\"{$this->input->id}\"";
		if( $this->input->required )
		{
			$additionalClasses .= " required";
		}

		// FIXME azz...
		if( $this->input->errorMessage )
		{
			$additionalClasses .= " error";
			$validation = "\n<div class=\"validation\">{$this->input->errorMessage}</div>";
		}

		return "\n<label{$for}>{$this->text}</label>";
	}
}