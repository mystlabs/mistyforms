<?php

namespace MistyForms;

use MistyForms\Exception\ConfigurationException;

/**
 * Base class for renderable plugins
 */
abstract class FormPlugin
{
	public $class;
	public $attributes;

	public function __construct( array $attributes )
	{
		$this->attributes = $attributes;
		$this->class = $this->optionalAttribute( 'class', '' );
	}

	/**
	 * Render the plugin to HTML
	 */
	abstract public function render();

	/**
	 * Remove and return param with index $name from $attributes,
	 * or return a default value if not present
	 */
	protected function optionalAttribute( $name, $default = null )
	{
		if( isset( $this->attributes[$name] ) )
		{
			$value = $this->attributes[$name];
			unset( $this->attributes[$name]);
			return $value;
		}
		else
		{
			return $default;
		}
	}

	/**
	 * Remove and return param with index $name from $attributes,
	 * or throws an exception if not present
	 */
	protected function requiredAttribute( $name )
	{
		$value = $this->optionalAttribute( $name );
		if( $value === null )
		{
			throw new ConfigurationException(sprintf(
				"Missing required attribute '%s' in %s",
				$name,
				get_class($this)
			));
		}
		return $value;
	}

	/**
	 * Transform all the remaining values in $attributes to $name='$value'
	 * and concatenates them
	 */
	protected function stringifyRemainingAttributes()
	{
		$extras = '';
		foreach( $this->attributes as $name => $value )
		{
			$extras .= " $name=\"$value\"";
		}
		return $extras;
	}

	/**
	 * Tranform the user defined classes and the default classes to a
	 * class="val1 val2" form
	 */
	protected function stringifyClass( $additionalClasses=false )
	{
		if( $additionalClasses && $this->class )
		{
			return " class=\"{$additionalClasses} {$this->class}\"";
		}
		else if( $additionalClasses && !$this->class )
		{
			return " class=\"{$additionalClasses}\"";
		}
		else if( $this->class && !$additionalClasses )
		{
			return " class=\"{$this->class}\"";
		}
		else
		{
			return '';
		}
	}

	/**
	 * Utility method to read a value from an array,
	 * and return a default value if not present
	 */
	protected static function readParam( array $params, $name, $default = null )
	{
		if( isset( $params[$name] ) )
		{
			return $params[$name];
		}
		else
		{
			return $default;
		}
	}
}