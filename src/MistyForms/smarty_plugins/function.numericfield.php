<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\NumericField;

function smarty_function_numericfield( $params, $smarty )
{
	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new NumericField( $params, $smarty->getTemplateVars() ) );
}