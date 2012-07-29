<?php

namespace MistyForms;

class FormBlockHelper
{
	const VIEW_KEY = '_mistyforms_block';

	public static function toSmarty( $smarty, $formBlock )
	{
		$smarty->assign( self::VIEW_KEY, $formBlock );
	}

	public static function fromSmarty( $smarty )
	{
		$vars = $smarty->getTemplateVars();

		if( !isset( $vars[self::VIEW_KEY] ) )
		{
			throw new ConfigurationException( 'The form is missing. This is probably a bug' );
		}

		return $vars[self::VIEW_KEY];
	}
}