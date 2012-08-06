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

		if( $this->value && filter_var( $this->value, FILTER_VALIDATE_EMAIL ) === false )
		{
			$this->errorMessage = "Please enter a valid e-mail address.";
			return false;
		}

		return true;
	}
}