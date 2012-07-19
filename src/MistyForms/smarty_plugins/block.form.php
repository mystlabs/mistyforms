<?php

use MistyForms\Form;
use MistyForms\FormBlock;
use MistyForms\Handler;

/**
 *
 */
function smarty_block_form($params, $content, $smarty, &$isOpeningTag)
{
	// default form id
	if( !isset( $params['id'] ) )
		$params['id'] = 'mistyforms';

	if( $isOpeningTag )
	{
		$handler = Handler::fromSmarty( $smarty );
		$handler->initialize( $smarty );

		$form = new Form( $handler, isset($_POST) ? $_POST : null );
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