<?php

use Mist\Form\Input\SelectBox;
use Mist\Form\Input\TextField;
use Mist\Form\FormBlock;

function smarty_function_selectbox( $params, $smarty )
{
	return FormBlock::addInput( new SelectBox( $params, $smarty ) );
}