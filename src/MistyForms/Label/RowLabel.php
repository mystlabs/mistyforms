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
		$additionalClasses = strlen( $this->class ) > 0 ? " " . $this->class : "";
		$extras = $this->stringifyRemainingAttributes();

		$for = "";
		$validation = "";
		if( $this->input )
		{
			$for = " for=\"{$this->input->id}\"";
			if( $this->input->required )
			{
				$additionalClasses .= " required";
			}

			if( $this->input->errorMessage )
			{
				$additionalClasses .= " error";
				$validation = "\n<div class=\"validation\">{$this->input->errorMessage}</div>";
			}
		}

		return
		"\n<div class=\"formrow{$additionalClasses}\"{$extras}>" .
		"\n\t<label{$for}>{$this->text}</label>\n" .
		$this->content .
		$validation .
		"\n</div>";
	}
}