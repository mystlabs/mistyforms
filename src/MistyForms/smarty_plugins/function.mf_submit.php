<?php

use MistyForms\Action\Submit;
use MistyForms\FormBlockHelper;

function smarty_function_mf_submit( $params, $smarty )
{
	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderAction( new Submit( $params ) );
}
