<?php

namespace MistyForms\Input;

use MistyForms\Input\InputHelper;

class Select extends Input
{
    public $options;
    public $selected;

    protected function initialize()
    {
        $this->options = InputHelper::parseOptions($this->requiredAttribute('options'));
        $this->selected = $this->optionalAttribute('selected', null);
    }

    public function fromView(array $params)
    {
        $value = self::readParam($params, $this->name, null);
        if ($value !== null) {
            $this->selected = $value;
        }
    }

    public function _fromRequest(array $request)
    {
        $this->selected = null;
        if (isset($request[$this->id])) {
            $this->selected = $request[$this->id];
        }
    }

    public function _getData()
    {
        return $this->selected;
    }

    public function validate()
    {
        if ($this->required && ($this->selected === null || $this->selected === '')) {
            $this->errorMessage = "Please select an item.";
            return false;
        }

        if ($this->selected && !InputHelper::isValidValue($this->selected, $this->options)) {
            $this->errorMessage = "Invalid selection.";
            return false;
        }

        return true;
    }

    public function render()
    {
        $options = array();
        foreach ($this->options as $option) {
            $options[] = sprintf(
                '<option value="%s"%s>%s</option>',
                $option['value'],
                $this->stringifySelected($option['value']),
                $option['text']
            );
        }

        return sprintf(
            '<select name="%s" id="%s"%s%s%s>%s</select>',
            $this->name,
            $this->id,
            $this->stringifyClass(),
            $this->stringifyReadOnly(),
            $this->stringifyRemainingAttributes(),
            implode("\n", $options)
        );
    }

    protected function stringifySelected($value)
    {
        if (strval($this->selected) !== strval($value)) return '';

        return ' selected="selected"';
    }
}