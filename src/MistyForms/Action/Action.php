<?php

namespace MistyForms\Action;

use MistyForms\FormPlugin;

abstract class Action extends FormPlugin
{
    public $id;
    public $name;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->id = $this->requiredAttribute('id');
        $this->name = $this->optionalAttribute('name', $this->id);
    }
}