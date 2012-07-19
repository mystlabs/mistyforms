<?php

use Mist\Form\FormBlock;
use Mist\Form\Label\RowLabel;

function smarty_block_rowlabel($params, $content, $smarty, &$isOpeningTag)
{
	// we don't have anything to do when the block is open
	if($isOpeningTag) return '';

	$inputId = false;
	if( isset( $params['for'] ) )
	{
		$inputId = $params['for'];
		unset( $params['for'] );
	}

	$params['content'] = $content;
	$label = new RowLabel( $params );

	return FormBlock::addLabel( $label, $inputId );
}