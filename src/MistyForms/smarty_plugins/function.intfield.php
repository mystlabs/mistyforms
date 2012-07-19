<?php

use Mist\Form\Input\IntField;
use Mist\Form\FormBlock;

function smarty_function_intfield( $params, $smarty )
{
	return FormBlock::addInput( new IntField( $params, $smarty ) );
}