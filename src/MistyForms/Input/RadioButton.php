<?php

namespace Mist\Form\Input;

use Mist\Http\Request;
use Mist\Presentation\View;

class RadioButton extends Input
{
	public $items;
	public $selected;

	protected function initialize()
	{
		$this->items = $this->requiredAttribute( 'items' );
		$this->selected = $this->optionalAttribute( 'selected', null );
	}

	public function fromView( array $params )
	{
		$this->selected = self::readParam( $params, $this->name, '' );
	}

	public function _fromRequest( Request $request )
	{
		// TODO check with $this->items
		$this->selected = $request->getPost( $this->name );
	}

	public function _assignData( &$result )
	{
		$result[$this->name] = $this->selected;
	}

	public function validate()
	{
		if( $this->required )
		{
			$found = false;
			foreach( $this->items as $item )
			{
				$found = $found || ( $item['value'] == $this->selected );
			}

			if( !$found )
			{
				$this->errorMessage = "Devi selezionare almeno un'opzione.";
				return false;
			}
		}

		return true;
	}

	public function render()
	{
		$radiobuttons = array();
		foreach( $this->items as $key => $item )
		{
			$id = isset( $item['id'] ) ? $item['id'] : $this->id .'_rb_' . $key;

			$inputAndLabel = sprintf(
				'<input type="radio" name="%s" id="%s" value="%s"%s%s%s%s /><label for="%s">%s</label>',
				// radio box
				$this->name,
				$id,
				$item['value'],
				$this->stringifyClass(),
				$this->stringifyChecked($item['value']),
				$this->stringifyReadOnly(),
				$this->stringifyRemainingAttributes(),
				// label
				$this->id,
				$item['text']
			);

			$radiobuttons[] = '<span class="radiooption">' . $inputAndLabel . '</span>';
		}

		return '<div class="radiooptions">' . implode( '', $radiobuttons ) . '</div>';
	}

	/**
	 * Re-define this method to use 'disabled' instead of 'readonly'
	 */
	protected function stringifyReadOnly()
	{
		if( !$this->readOnly ) return '';

		return ' disabled="disabled"';
	}

	protected function stringifyChecked($value)
	{
		if( $this->value !== $value ) return '';

		return ' checked="checked"';
	}
}