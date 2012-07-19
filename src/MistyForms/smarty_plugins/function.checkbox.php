<?php

use Mist\Form\Input\CheckBox;
use Mist\Form\Input\TextField;
use Mist\Form\FormBlock;

function smarty_function_checkbox( $params, $smarty )
{
	return FormBlock::addInput( new CheckBox( $params, $smarty ) );
}