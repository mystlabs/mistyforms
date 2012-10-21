<?php

namespace MistyForms\Label;

use MistyForms\Input\Input;
use MistyForms\FormPlugin;

/**
 * Base class for all labels
 */
abstract class Label extends FormPlugin
{
    public $for;
    public $text;
    public $input;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->text = $this->requiredAttribute('text');

        $this->initialize();
    }

    protected function initialize()
    {
    }

    public function setInput(Input $input)
    {
        $this->input = $input;
    }
}