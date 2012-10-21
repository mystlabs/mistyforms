<?php

namespace MistyForms\Input;

class TextArea extends TextField
{
    public function render()
    {
        return sprintf(
            '<textarea name="%s" id="%s"%s%s%s%s>%s</textarea>',
            $this->name,
            $this->id,
            $this->stringifyClass(),
            $this->stringifyReadOnly(),
            $this->stringifyMaxLength(),
            $this->stringifyRemainingAttributes(),
            $this->value
        );
    }
}