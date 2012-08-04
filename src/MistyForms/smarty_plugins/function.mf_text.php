<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\TextField;

function smarty_function_mf_text( $params, $smarty )
{
	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new TextField( $params, $smarty->getTemplateVars() ) );
}