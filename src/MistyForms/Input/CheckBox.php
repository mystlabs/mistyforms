<?php

namespace MistyForms\Input;

class CheckBox extends Input
{
    public $checked;

    protected function initialize()
    {
        $this->checked = (bool)$this->optionalAttribute('checked', '');
    }

    public function fromView(array $params)
    {
        $this->checked = (bool)self::readParam($params, $this->name, $this->checked);
    }

    public function _fromRequest(array $request)
    {
        if (isset($request[$this->id])) {
            $this->checked = (bool)$request[$this->id];
        }
    }

    protected function _getData()
    {
        return $this->checked;
    }

    public function validate()
    {
        if ($this->required && !$this->checked) {
            $this->errorMessage = "This is required";
            return false;
        }

        return true;
    }

    public function render()
    {
        return sprintf(
            '<input type="checkbox" name="%s" id="%s"%s%s%s%s />',
            $this->name,
            $this->id,
            $this->stringifyClass(),
            $this->stringifyChecked(),
            $this->stringifyReadOnly(),
            $this->stringifyRemainingAttributes()
        );
    }

    protected function stringifyChecked()
    {
        if (!$this->checked) return '';

        return ' checked="checked"';
    }
}