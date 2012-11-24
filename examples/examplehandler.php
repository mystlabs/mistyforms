<?php

require '../vendor/autoload.php';

// view configuration here - see
$view = new Smarty();

$view->setTemplateDir(__DIR__ . '/tmp/');
$view->setCompileDir(__DIR__ . '/tmp/');
$view->setConfigDir(__DIR__ . '/tmp/');
$view->setCacheDir(__DIR__ . '/tmp/');

class ExampleHandler implements MistyForms\Handler
{
    public function initializeView($view)
    {
        $view->assign('radioOptions', array(
            0 => 'Option A',
            1 => 'Option B',
            2 => 'Option C'
        ));

        $view->assign('selectOptions', array(
            1 => 'Option A',
            2 => 'Option B',
            3 => 'Option C',
            4 => 'Option D',
            5 => 'Option E',
            6 => 'Option F',
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

        print_r($data);
        exit;
    }
}

$view->addPluginsDir('../src/smarty_plugins/');
$view->compile_check = true;
MistyForms\Form::setupForm($view, new \ExampleHandler());

$view->display($template);