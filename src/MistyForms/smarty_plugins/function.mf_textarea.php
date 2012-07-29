<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\TextArea;

function smarty_function_mf_textarea( $params, $smarty )
{
	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderInput( new TextArea( $params, $smarty->getTemplateVars() ) );
}