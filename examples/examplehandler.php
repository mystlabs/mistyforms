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
		$view->assign('radiobuttons', array(
			0 => 'A',
			1 => 'B',
			2 => 'C'
		));

		$view->assign('selects', array(
			1 => 'Africa',
			2 => 'Asia',
			3 => 'Europe',
			4 => 'North America',
			5 => 'South America',
			6 => 'Oceania',
		));
		// assign to the view the variable you need for this form
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

echo $view->display($template);