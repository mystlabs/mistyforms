<?php

use MistyForms\Action\Submit;
use MistyForms\FormBlock;

function smarty_function_submit( $params, $smarty )
{
	$formBlock = FormBlock::fromSmarty( $smarty );
	return $formBlock->registerAndRenderAction( new Submit( $params ) );
}
