<?php

require_once __DIR__ . '/../src/MistyForms/loader.php';

use MistyForms\Handler;
use MistyForms\Input\Input;

class MistyForms_Test extends PHPUnit_Framework_TestCase
{
}

/**
 * Handler without actions
 */
class NullHandler implements Handler
{
	public $initialized = false;

	public function initialize( $view )
	{
		$this->initialized = true;
	}
}

/**
 * Handler with 2 actions
 */
class DualActionHandler extends NullHandler
{
	public $handledAction1 = false;
	public $handledAction2 = false;
	public $formData = null;

	private $action1Result;
	private $action2Result;

	public function __construct( $action1Result=true, $action2Result=true )
	{
		$this->action1Result = $action1Result;
		$this->action2Result = $action2Result;
	}

	public function action1( $data )
	{
		$this->handledAction1 = true;
		$this->formData = $data;

		return $this->action1Result;
	}

	public function action2( $data )
	{
		$this->handledAction2 = true;
		$this->formData = $data;

		return $this->action2Result;
	}
}
