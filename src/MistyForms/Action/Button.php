<?php

namespace MistyForms\Action;

use MistyForms\Action\Action;
use MistyForms\Exception\ConfigurationException;

/**
 * Form action in the form <button></button>
 */
class Button extends Action
{
    public $content;

    public function __construct(array $attributes, $content)
    {
        parent::__construct($attributes);

        if (!$content) {
            throw new ConfigurationException(sprintf(
                'Missing content for Button: %s',
                $this->id
            ));
        }

        $this->content = $content;
    }

    public function render()
    {
        return sprintf(
            '<button name="%s" id="%s"%s%s>%s</button>',
            $this->name,
            $this->id,
            $this->stringifyClass(),
            $this->stringifyRemainingAttributes(),
            $this->content
        );
    }
}