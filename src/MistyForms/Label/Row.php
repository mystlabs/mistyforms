<?php

namespace MistyForms\Label;

use MistyForms\Input\Input;

class Row extends Label
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
		$classes = 'mf_row';
		if( $this->input && $this->input->required ) $classes .= ' mf_required';
		if( $this->input && $this->input->errorMessage ) $classes .= ' mf_invalid';

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
			return "<div class=\"mf_errormessage\">{$this->input->errorMessage}</div>";
		}
	}
}