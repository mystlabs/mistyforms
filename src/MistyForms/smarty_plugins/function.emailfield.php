<?php

use Mist\Form\Input\EmailField;
use Mist\Form\FormBlock;

function smarty_function_emailfield( $params, $smarty )
{
	return FormBlock::addInput( new EmailField( $params, $smarty ) );
}