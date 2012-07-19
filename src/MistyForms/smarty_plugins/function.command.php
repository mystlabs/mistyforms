<?php

use Mist\Form\Command\Command;
use Mist\Form\Input\TextField;
use Mist\Form\FormBlock;

function smarty_function_command( $params, $smarty )
{
	return FormBlock::addCommand( new Command( $params ) );
}