<?php

use MistyForms\FormBlockHelper;
use MistyForms\Action\Button;

function smarty_block_button($params, $content, $smarty, &$isOpeningTag)
{
	// we don't have anything to do when the block is open
	if($isOpeningTag) return '';

	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderAction( new Button( $params, $content ) );
}
