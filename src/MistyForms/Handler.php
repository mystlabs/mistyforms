<?php

namespace MistyForms;

abstract class Handler
{
	public function initialize( $view )
	{
		// Nothing to do, it should be overriden by the child class if the form needs data
	}

	public function handle( Form $form, $command )
	{
		if( !method_exists( $this, $command ) )
		{
			$this->notifier->error( 'Il pulsante cliccato non è attivo.' );
			return false;
		}

		// TODO add custom validators maybe?

		if( $form->hasErrors() )
		{
			return false;
		}

		return $this->$command( $form->getData() );
	}

	public static function fromSmarty( $smarty )
	{
		$vars = $smarty->getTemplateVars();
		return $vars['_mistyforms_handler'];
	}
}