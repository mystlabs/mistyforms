<?php

namespace MistyForms\Action;

use MistyForms\Action\Action;

/**
 * Form action in the form <input type="submit" />
 */
class Submit extends Action
{
	public $value;

	public function __construct( array $attributes )
	{
		parent::__construct( $attributes );

		$this->value = $this->requiredAttribute( 'value' );
	}

	public function render()
	{
		return sprintf(
			'<input type="submit" name="%s" id="%s" value="%s"%s%s />',
			$this->name,
			$this->id,
			$this->value,
			$this->stringifyClass(),
			$this->stringifyRemainingAttributes()
		);
	}
}