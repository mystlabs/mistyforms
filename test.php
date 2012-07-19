<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('../Smarty/distribution/libs/Smarty.class.php');

// view configuration here - see
$view = new Smarty();

$view->setTemplateDir('../tmp/');
$view->setCompileDir('../tmp/');
$view->setConfigDir('../tmp/');
$view->setCacheDir('../tmp/');

// load MistyForms
require_once('src/MistyForms/loader.php');

class ExampleHandler extends MistyForms\Handler
{
	public function initialize( $view )
	{
		// assign to the view the variable you need for this form
		$view->assign('var', 'value');
	}

	// this is the name of the 'command' in the template
	public function actionName($data)
	{
		// $data is an associative array containing the already-validated user input

		// return false; // if anything went wrong, show the form again
		// return true; // show a new and empty form
		// redirect // probably the best option after a successful form submission
	}
}

$view->addPluginsDir(MISTYFORMS_PATH.'/smarty_plugins/');
$view->assign('_mistyforms_handler', new \ExampleHandler() );

echo $view->display('test.tpl');