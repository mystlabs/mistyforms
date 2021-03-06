<?php

namespace MistyForms;

use MistyForms\Input\Input;
use MistyForms\Label\Label;

class FormBlock extends FormPlugin
{
    private $form;
    private $action;

    public function __construct(Form $form, array $attributes)
    {
        parent::__construct($attributes);

        $this->form = $form;

        $this->action = $this->optionalAttribute('action', '');
    }

    public function renderWithContent($content)
    {
        return sprintf(
            '<form action="%s" method="POST"%s%s>%s%s</form>',
            $this->action,
            $this->stringifyClass('mf_form'),
            $this->stringifyRemainingAttributes(),
            $this->validationErrorMessage(),
            $content
        );
    }

    public function render()
    {
        throw new \BadMethodCallException("Unsupported method render() on " . get_class() . ", user renderWithContent() instead");
    }

    public function __call($method, $args)
    {
        if (method_exists($this->form, $method)) {
            return call_user_func_array(array($this->form, $method), $args);
        }

        throw new \BadMethodCallException("Unknown method {$method} in " . get_class());
    }

    /**
     * To be implemented
     */
    protected function validationErrorMessage()
    {
        if ($this->form->hasErrors()) {
            return '<p class="mf_formstatus">Please correct the highlighted errors before proceeding.</p>';
        }

        return '';
    }
}