<?php

namespace MistyForms\Action;

use MistyForms\Action\Action;

/**
 * Form action in the form <input type="submit" />
 */
class Submit extends Action
{
	public $text;

	public function __construct( array $attributes )
	{
		parent::__construct( $attributes );

		$this->text = $this->requiredAttribute( 'text' );
	}

	public function render()
	{
		return sprintf(
			'<input type="submit" name="%s" id="%s" value="%s"%s%s />',
			$this->name,
			$this->id,
			$this->text,
			$this->stringifyClass(),
			$this->stringifyRemainingAttributes()
		);
	}
}