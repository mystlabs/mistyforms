<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\EmailField;

function smarty_function_mf_emailfield( $params, $smarty )
{
	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new EmailField( $params, $smarty->getTemplateVars() ) );
}