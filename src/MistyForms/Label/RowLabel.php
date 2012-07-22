<?php

namespace MistyForms\Label;

use MistyForms\Input\Input;

class RowLabel extends Label
{
	public $content;

	public function __construct( array $attributes, $content )
	{
		parent::__construct( $attributes );
		$this->content = $content;
	}

	public function render()
	{
		return sprintf(
			'<div%s%s><label%s>%s</label>%s%s</div>',
			$this->stringifyClass( $this->defaultClasses() ),
			$this->stringifyRemainingAttributes(),
			$this->stringifyFor(),
			$this->text,
			$this->content,
			$this->stringifyErrorMessage()
		);
	}

	protected function defaultClasses()
	{
		$classes = 'formrow';
		if( $this->input && $this->input->required ) $classes .= ' required';
		if( $this->input && $this->input->errorMessage ) $classes .= ' error';

		return $classes;
	}

	protected function stringifyFor()
	{
		if( !$this->input ) return '';

		return " for=\"{$this->input->id}\"";
	}

	protected function stringifyErrorMessage()
	{
		if( $this->input && $this->input->errorMessage )
		{
			return "\n<div class=\"validation\">{$this->input->errorMessage}</div>";
		}
	}
}