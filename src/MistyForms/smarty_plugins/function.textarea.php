<?php

use Mist\Form\Input\TextArea;
use Mist\Form\Input\TextField;
use Mist\Form\FormBlock;

function smarty_function_textarea( $params, $smarty )
{
	return FormBlock::addInput( new TextArea( $params, $smarty ) );
}