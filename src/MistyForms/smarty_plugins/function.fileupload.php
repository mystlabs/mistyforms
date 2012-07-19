<?php

use Mist\Form\Input\FileUpload;
use Mist\Form\FormBlock;

function smarty_function_fileupload( $params, $smarty )
{
	return FormBlock::addInput( new FileUpload( $params, $smarty ) );
}