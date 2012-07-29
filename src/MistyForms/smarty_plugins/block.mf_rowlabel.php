<?php

use MistyForms\FormBlockHelper;
use MistyForms\Label\RowLabel;

function smarty_block_mf_rowlabel($params, $content, $smarty, &$isOpeningTag)
{
	// we don't have anything to do when the block is open
	if($isOpeningTag) return '';

	$inputId = false;
	if( isset( $params['for'] ) )
	{
		$inputId = $params['for'];
		unset( $params['for'] );
	}

	$formBlock = FormBlockHelper::fromSmarty( $smarty );
	return $formBlock->registerAndRenderLabel( new RowLabel( $params, $content ), $inputId );
}
