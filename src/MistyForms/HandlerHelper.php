<?php

namespace MistyForms;

use MistyForms\Exception\ConfigurationException;
use MistyForms\Handler;

class HandlerHelper
{
	/**
	 * Static function to save the handler in the view
	 */
	public static function toSmarty( $smarty, Handler $handler )
	{
		$smarty->assign( '_mistyforms_handler', $handler );
	}

	/**
	 * Static function to retrieve the handler from the view
	 */
	public static function fromSmarty( $smarty )
	{
		$vars = $smarty->getTemplateVars();

		if( !isset( $vars['_mistyforms_handler'] ) )
		{
			throw new ConfigurationException( 'The form handler is missing. Did you call Form::setupForm()?' );
		}

		$handler = $vars['_mistyforms_handler'];
		if( !$handler instanceof Handler )
		{
			throw new ConfigurationException( 'The handler is not of type MistyForms\Handler' );
		}

		return $handler;
	}
}