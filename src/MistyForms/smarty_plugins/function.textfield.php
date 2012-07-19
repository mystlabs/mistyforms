<?php

use MistyForms\Input\TextField;
use MistyForms\FormBlock;

function smarty_function_textfield( $params, $smarty )
{
	$formBlock = FormBlock::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new TextField( $params, $smarty->getTemplateVars() ) );
}