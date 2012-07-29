<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\InputHelper;

class InputHelperTest extends MistyForms_Test
{
	private $options;

	public function setup()
	{
		$this->options = array(
			1 => 'val1',
			2 => 'val2',
			3 => 'val3',
		);
	}

	public function testIsValidValue()
	{
		$options = InputHelper::parseOptions( array(
			0 => 'val',
			1 => 'val',
			2 => 'val',
			'num' => 'val',
			'test' => 'val',
		));

		$this->assertTrue( InputHelper::isValidValue( 0, $options ) );
		$this->assertTrue( InputHelper::isValidValue( '0', $options ) );
		$this->assertTrue( InputHelper::isValidValue( 1, $options ) );
		$this->assertTrue( InputHelper::isValidValue( '1', $options ) );
		$this->assertTrue( InputHelper::isValidValue( 'test', $options ) );

		$this->assertFalse( InputHelper::isValidValue( null, $options ) );
		$this->assertFalse( InputHelper::isValidValue( '', $options ) );
		$this->assertFalse( InputHelper::isValidValue( 'test2', $options ) );
	}

	public function testParseOptions()
	{
		$expected = array( array( 'value' => 1, 'text' => 'Text1' ), array( 'value' => 2, 'text' => 'Text2' ) );
		$actual = InputHelper::parseOptions( array( 1 => 'Text1', 2 => 'Text2') );

		$this->assertEquals( $expected, $actual );

		$expected = array( array( 'value' => 1, 'text' => 'Text1' ), array( 'value' => 2, 'text' => 'Text2' ) );
		$actual = InputHelper::parseOptions( $expected );

		$this->assertEquals( $expected, $actual );
	}
}
