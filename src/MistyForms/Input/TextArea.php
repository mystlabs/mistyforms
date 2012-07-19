<?php

namespace MistyForms\Input;

class TextArea extends TextField
{
	public function render()
	{
		$name = " name=\"". $this->name ."\"";
		$id = " id=\"". $this->id ."\"";
		$class = strlen( $this->class ) > 0 ? " class=\"". $this->class ."\"" : "";
		$readOnly = $this->readOnly ? " readonly=\"readonly\"" : "";
		$maxLength = $this->maxLength > 0 ? " maxlength=\"". $this->maxLength ."\"" : "";
		$extras = $this->stringifyRemainingAttributes();

		return "<textarea{$name}{$id}{$class}{$readOnly}{$maxLength}{$extras}>{$this->value}</textarea>";
	}
}