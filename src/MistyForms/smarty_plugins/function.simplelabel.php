<?php

use Mist\Form\Label\SimpleLabel;
use Mist\Form\Input\SelectBox;
use Mist\Form\Input\TextField;
use Mist\Form\FormBlock;

function smarty_function_simplelabel( $params, $smarty )
{
	$inputId = false;
	if( isset( $params['for'] ) )
	{
		$inputId = $params['for'];
		unset( $params['for'] );
	}
	
	return FormBlock::addLabel( new SimpleLabel( $params ), $inputId );
}