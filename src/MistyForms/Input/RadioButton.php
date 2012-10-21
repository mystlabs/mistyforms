<?php

namespace MistyForms\Input;

use MistyForms\Input\InputHelper;

class RadioButton extends Input
{
    public $options;
    public $checked;

    protected function initialize()
    {
        $this->options = InputHelper::parseOptions($this->requiredAttribute('options'));
        $this->checked = $this->optionalAttribute('checked', null);
    }

    public function fromView(array $params)
    {
        $this->checked = self::readParam($params, $this->name, $this->checked);
    }

    public function _fromRequest(array $request)
    {
        if (isset($request[$this->id])) {
            $this->checked = $request[$this->id];
        }
    }

    protected function _getData()
    {
        return $this->checked;
    }

    public function validate()
    {
        if ($this->required && !$this->checked) {
            $this->errorMessage = "Please select an item.";
            return false;
        }

        if ($this->checked && !InputHelper::isValidValue($this->checked, $this->options)) {
            $this->errorMessage = "Invalid selection.";
            return false;
        }

        return true;
    }

    public function render()
    {
        $radiobuttons = array();
        foreach ($this->options as $key => $option) {
            $id = isset($option['id']) ? $option['id'] : $this->id . '_rb_' . $key;

            $inputAndLabel = sprintf(
                '<input type="radio" name="%s" id="%s" value="%s"%s%s /><label for="%s">%s</label>',
                // radio box
                $this->name,
                $id,
                $option['value'],
                $this->stringifyChecked($option['value']),
                $this->stringifyReadOnly(),
                // label
                $id,
                $option['text']
            );

            $radiobuttons[] = '<span>' . $inputAndLabel . '</span>';
        }

        return sprintf(
            '<div%s%s>%s</div>',
            $this->stringifyClass('mf_options'),
            $this->stringifyRemainingAttributes(),
            implode('', $radiobuttons)
        );
    }

    /**
     * Re-define this method to use 'disabled' instead of 'readonly'
     */
    protected function stringifyReadOnly()
    {
        if (!$this->readOnly) return '';

        return ' disabled="disabled"';
    }

    protected function stringifyChecked($value)
    {
        if (strval($this->checked) !== strval($value)) return '';

        return ' checked="checked"';
    }
}
