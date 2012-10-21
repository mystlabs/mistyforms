<?php

namespace MistyForms\Input;

use MistyForms\FormPlugin;

/**
 * Base class for all Input fields
 */
abstract class Input extends FormPlugin
{
    public $id;
    public $name;
    public $readOnly;
    public $required;
    public $attributes;

    public $errorMessage;

    public function __construct(array $attributes, array $templateVars)
    {
        parent::__construct($attributes);

        $this->id = $this->requiredAttribute('id');
        $this->name = $this->optionalAttribute('name', $this->id);
        $this->readOnly = $this->optionalAttribute('readOnly', false);
        $this->required = $this->optionalAttribute('required', false); // should it be here? mmm

        $this->initialize();
        $this->fromView($templateVars);
    }

    /**
     * Plugins can implement this function to setup additional fields before fromView is executed
     */
    protected function initialize()
    {
    }

    /**
     * Read the default value from the variables assigned to the template
     * If it's a POST request this value will be later overriden in fromRequest
     */
    abstract protected function fromView(array $templateVars);

    /**
     * Read the value posted from the user from $requestParams
     * This will only invoked if it's a POST request
     */
    public final function fromRequest(array $requestParams)
    {
        if (!$this->readOnly) {
            $this->_fromRequest($requestParams);
        }
    }

    /**
     * Read the value posted from the user from $requestParams
     * This will only invoked if it's a POST request and if the field was not read only
     */
    abstract protected function _fromRequest(array $requestParams);

    /**
     * Invoked if there were no error in the form
     * Collects the data that the form will return
     */
    public function getData()
    {
        if (!$this->readOnly) {
            return $this->_getData();
        }
    }

    /**
     * Invoked if there were no error in the form
     * Every plugin should return its value/s
     */
    abstract protected function _getData();

    /**
     * Validate that all the requirements of this input plugin were satisfied
     */
    abstract public function validate();

    protected function stringifyReadOnly()
    {
        if (!$this->readOnly) return '';

        return ' readonly="readonly"';
    }
}