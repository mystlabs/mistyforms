<?php

use MistyForms\FormBlock;
use MistyForms\Input\NumericField;

function smarty_function_numericfield( $params, $smarty )
{
	$formBlock = FormBlock::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new NumericField( $params, $smarty->getTemplateVars() ) );
}