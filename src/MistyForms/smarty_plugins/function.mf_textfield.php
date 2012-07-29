<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\TextField;

function smarty_function_mf_textfield( $params, $smarty )
{
	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new TextField( $params, $smarty->getTemplateVars() ) );
}