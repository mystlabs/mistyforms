<?php

namespace MistyForms\Input;

class EmailField extends TextField
{
	protected function initialize()
	{
		parent::initialize();

		$this->type = 'email';
	}

	public function validate()
	{
		if( !parent::validate() )
		{
			return false;
		}

		if( filter_var( $this->value, FILTER_VALIDATE_EMAIL ) === false )
		{
			$this->errorMessage = "L'indirizzo e-mail non è valido.";
			return false;
		}

		return true;
	}
}