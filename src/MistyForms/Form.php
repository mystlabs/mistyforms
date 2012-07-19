<?php

namespace MistyForms;

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
				throw new \Exception( "Trying to add a label to an input that doesn't exist: $inputId" );
			}

		}

		return $label->render();
	}

	/**
	 * Register a new Input field with this form, renders it and return the HTML code
	 */
	public function registerAndRenderInput( Input $input )
	{
		if( isset( $this->inputs[$input->id] ) )
		{
			throw new \Exception( "Duplicate name in Form: " . $input->id );
		}
		$this->inputs[$input->id] = $input;

		if( $this->isPostRequest )
		{
			$input->fromRequest( $this->postParams );
			$this->hasErrors = !$input->validate() || $this->hasErrors;
		}
		return $input->render();
	}

	public function registerAndRenderAction( Action $action )
	{
		if( isset( $this->inputs[$action->id] ) )
		{
			throw new \Exception( "A command cannot have the same id as an input field: " . $input->id );
		}

		if( isset( $this->commands[$action->id] ) )
		{
			throw new \Exception( "Duplicate command in Form: " . $action->name );
		}
		$this->commands[$action->id] = $action;

		return $action->render();
	}

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

	public function hasErrors()
	{
		return $this->hasErrors;
	}

	public function getData()
	{
		$data = array();
		foreach( $this->inputs->all() as $input )
		{
			$data[$input->id] = $input->getData();
		}

		return $data;
	}
}