<?php

use MistyForms\Form;
use MistyForms\FormBlock;
use MistyForms\Handler;
use MistyForms\HandlerHelper;

/**
 * Render a form, and handle validation if it's a POST request
 */
function smarty_block_form($params, $content, $smarty, &$isOpeningTag)
{
	// default form id
	if( !isset( $params['id'] ) )
		$params['id'] = 'mistyforms';

	if( $isOpeningTag )
	{
		$handler = HandlerHelper::fromSmarty( $smarty );
		$form = new Form( $handler, !empty($_POST) ? $_POST : null );
		$formBlock = new FormBlock( $form, $params );

		FormBlock::toSmarty( $smarty, $formBlock );
	}
	else
	{
		$formBlock = FormBlock::fromSmarty( $smarty );
		$formBlock->executeActions();
		return $formBlock->renderWithContent( $content );
	}
}