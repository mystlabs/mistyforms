<?php

use MistyForms\FormBlock;
use MistyForms\Input\TextField;

function smarty_function_textfield( $params, $smarty )
{
	$formBlock = FormBlock::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new TextField( $params, $smarty->getTemplateVars() ) );
}