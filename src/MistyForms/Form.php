<?php

namespace MistyForms;

use MistyForms\Exception\ConfigurationException;
use MistyForms\Handler;
use MistyForms\Input\Input;
use MistyForms\Label\Label;
use MistyForms\Action\Action;

/**
 * Main form class
 * It collects all Labels/Inputs/Commands and manages lifecycle and
 * validation of the form
 */
class Form
{
	private $handler;
	private $hasErrors;

	private $inputs;
	private $actions;

	private $postParams;
	private $isPostRequest;

	public function __construct( Handler $handler, $postParams )
	{
		$this->handler = $handler;
		$this->hasErrors = false;

		$this->inputs = array();
		$this->actions = array();

		$this->postParams = $postParams;
		$this->isPostRequest = $postParams !== null;
	}

	/**
	 * Register a new Label with this form, renders it and return the HTML code
	 */
	public function registerAndRenderLabel( Label $label, $inputId = false )
	{
		if( $inputId )
		{
			if( isset( $this->inputs[$inputId] ) )
			{
				$label->setInput( $this->inputs[$inputId] );
			}
			else
			{
				throw new ConfigurationException( sprintf(
					'Trying to add a label to an input that hasn\'t been added yet: %s',
					$inputId
				));
			}

		}

		return $label->render();
	}

	/**
	 * Register a new Input field with this form, renders it and return the HTML code
	 */
	public function registerAndRenderInput( Input $input )
	{
		$this->ensureIdIsUnique( $input->id );

		$this->inputs[$input->id] = $input;

		if( $this->isPostRequest )
		{
			$input->fromRequest( $this->postParams );
			$this->hasErrors = !$input->validate() || $this->hasErrors;
		}

		return $input->render();
	}

	/**
	 * Register a new Action with this form, renders it and return the HTML code
	 */
	public function registerAndRenderAction( Action $action )
	{
		$this->ensureIdIsUnique( $input->id );

		$this->commands[$action->id] = $action;

		return $action->render();
	}

	/**
	 * If it's a POST request go through all the registered actions and check if one of them has been submitted
	 */
	public function executeActions()
	{
		if( !$this->isPostRequest ) return;

		foreach( $this->actions->all() as $name => $action )
		{
			if( $this->request->getPost( $name, false ) )
			{
				return $this->handler->handle( $this, $name );
			}
		}
	}

	/**
	 * Boolean indicating whether there user input was valid or not
	 */
	public function hasErrors()
	{
		return $this->hasErrors;
	}

	/**
	 * Returns an array with all the data sent by the user
	 */
	public function getData()
	{
		$data = array();
		foreach( $this->inputs->all() as $input )
		{
			$data[$input->id] = $input->getData();
		}

		return $data;
	}

	/**
	 * Check that the id is unique within this form,
	 * and throw a MistyForms\Exception\ConfigurationException if not
	 */
	private function ensureIdIsUnique( $id )
	{
		if( isset( $this->inputs[$id] ) || isset( $this->actions[$id] ) )
		{
			throw new ConfigurationException( sprintf(
				'Duplicate ID '%s'. Every input/action must have a unique ID.',
				$id
			));
		}
	}
}