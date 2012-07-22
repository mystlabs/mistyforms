<?php

require_once __DIR__ . '/testenv.php';
require_once __DIR__ . '/config/smarty.config.php';
require_once SMARTY_FOLDER . '/distribution/libs/Smarty.class.php';

use MistyForms\Form;
use MistyForms\Handler;

class MistyForms_SmartyIntegTest extends MistyForms_Test
{
	protected $smarty;

	public function setUp()
	{
		$view = new Smarty();

		$view->setTemplateDir(SMARTY_TMP_FOLDER);
		$view->setCompileDir(SMARTY_TMP_FOLDER);
		$view->setConfigDir(SMARTY_TMP_FOLDER);
		$view->setCacheDir(SMARTY_TMP_FOLDER);

		$view->addPluginsDir(__DIR__.'/../src/MistyForms/smarty_plugins/');
		$view->compile_check = true;

		$this->smarty = $view;
	}

	protected function assertNodeExist($node)
	{
		$this->assertTrue((bool)$node);
	}
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

