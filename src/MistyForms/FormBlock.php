<?php

namespace MistyForms;

use MistyForms\Command\Command;
use MistyForms\Input\Input;
use MistyForms\Label\Label;

class FormBlock extends FormPlugin
{
	private $form;

	public function __construct( Form $form, array $attributes )
	{
		parent::__construct( $attributes );

		$this->form = $form;
	}

	public function renderWithContent( $content )
	{
		$class = ' class="form' . ( strlen( $this->class ) ? ' ' . $this->class : '' ) . '"';
		$extras = $this->stringifyRemainingAttributes();

		$validation = "";
		if( $this->form->hasErrors() )
		{
			$validation = "<div class=\"validation\"></div>";
		}

		return
			"\n<form action='' method='POST'{$enctype}{$class}{$extras}>" .
			$validation .
			$content .
			"\n</form>";
	}

	public function render()
	{
		throw new \Exception( "Unsupported method render() on " . get_class() . ", user renderWithContent() instead" );
	}

	public function __call( $method, $args )
	{
		if( method_exists( $this->form, $method ) )
		{
		      return call_user_func_array( array( $this->form, $method ), $args);
		}

		throw new \Exception( "Unknown method {$method} in " . get_class() );
	}

	public static function toSmarty( $smarty, $formBlock )
	{
		$smarty->assign( '_mistyforms_block', $formBlock );
	}

	public static function fromSmarty( $smarty )
	{
		$vars = $smarty->getTemplateVars();
		return $vars['_mistyforms_block'];
	}
}