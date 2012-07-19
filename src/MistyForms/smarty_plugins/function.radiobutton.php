<?php

use Mist\Form\Input\RadioButton;
use Mist\Form\Input\SelectBox;
use Mist\Form\Input\TextField;
use Mist\Form\FormBlock;

function smarty_function_radiobutton( $params, $smarty )
{
	return FormBlock::addInput( new RadioButton( $params, $smarty ) );
}