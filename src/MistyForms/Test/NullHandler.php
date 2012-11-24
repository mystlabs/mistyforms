<?php

namespace MistyForms\Test;

use MistyForms\Handler;

class NullHandler implements Handler
{
    public $initialized = false;

    public function initializeView($view)
    {
        $this->initialized = true;
    }
}