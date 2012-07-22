<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once(__DIR__.'/../libs/smarty/distribution/libs/Smarty.class.php');

// view configuration here - see
$view = new Smarty();

$view->setTemplateDir(__DIR__.'/tmp/');
$view->setCompileDir(__DIR__.'/tmp/');
$view->setConfigDir(__DIR__.'/tmp/');
$view->setCacheDir(__DIR__.'/tmp/');

// load MistyForms
require_once(__DIR__.'/../src/MistyForms/loader.php');

class ExampleHandler implements MistyForms\Handler
{
	public function initialize( $view )
	{
		// assign to the view the variable you need for this form
		$view->assign('var', 'Title');
	}

	// this is the name of the 'command' in the template
	public function actionName(array $data)
	{
		// $data is an associative array containing the already-validated user input

		// return false; // if anything went wrong, show the form again
		// return true; // show a new and empty form - not implemented
		// redirect // probably the best option after a successful form submission

		print_r( $data );
		exit;
	}
}

$view->addPluginsDir(MISTYFORMS_PATH.'/smarty_plugins/');
$view->compile_check = true;
MistyForms\Form::setupForm($view, new \ExampleHandler());

echo $view->display('example1.tpl');