<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\SelectBox;

class SelectBoxTest extends MistyForms_Test
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

	public function testRenderSelected()
	{
		$textField = new SelectBox(array(
			'id' => 'selectbox',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'selected' => 2
		), array());

		$expected = '<select name="selectbox" id="selectbox" class="className1 className2" additionalAttr="val">';
		$expected .= '<option value="1">val1</option>';
		$expected .= '<option value="2" selected="selected">val2</option>';
		$expected .= '<option value="3">val3</option>';
		$expected .= '</select>';

		$html = str_replace( "\n", '', $textField->render() );

		$this->assertEquals($expected, $html);
	}

	public function testRenderWithValue()
	{
		$textField = new SelectBox(array(
			'id' => 'selectbox',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'selected' => 2
		), array(
			'selectbox' => 1
		));

		$expected = '<select name="selectbox" id="selectbox" class="className1 className2" additionalAttr="val">';
		$expected .= '<option value="1" selected="selected">val1</option>';
		$expected .= '<option value="2">val2</option>';
		$expected .= '<option value="3">val3</option>';
		$expected .= '</select>';

		$html = str_replace( "\n", '', $textField->render() );

		$this->assertEquals($expected, $html);
	}

	public function testValidateWithInvalidValue()
	{
		$textField = new SelectBox(array(
			'id' => 'selectbox',
			'options' => $this->options,
		), array());
		$textField->fromRequest(array(
			'selectbox' => 4
		));

		$this->assertFalse($textField->validate());
	}

	public function testIsValidValue()
	{
		$options = SelectBoxHelpTester::parseOptions( array(
			0 => 'val',
			1 => 'val',
			2 => 'val',
			'num' => 'val',
			'test' => 'val',
		));

		$this->assertTrue( SelectBoxHelpTester::isValidValue( 0, $options ) );
		$this->assertTrue( SelectBoxHelpTester::isValidValue( '0', $options ) );
		$this->assertTrue( SelectBoxHelpTester::isValidValue( 1, $options ) );
		$this->assertTrue( SelectBoxHelpTester::isValidValue( '1', $options ) );
		$this->assertTrue( SelectBoxHelpTester::isValidValue( 'test', $options ) );

		$this->assertFalse( SelectBoxHelpTester::isValidValue( null, $options ) );
		$this->assertFalse( SelectBoxHelpTester::isValidValue( '', $options ) );
		$this->assertFalse( SelectBoxHelpTester::isValidValue( 'test2', $options ) );
	}

	public function testParseOptions()
	{
		$expected = array( array( 'value' => 1, 'text' => 'Text1' ), array( 'value' => 2, 'text' => 'Text2' ) );
		$actual = SelectBoxHelpTester::parseOptions( array( 1 => 'Text1', 2 => 'Text2') );

		$this->assertEquals( $expected, $actual );

		$expected = array( array( 'value' => 1, 'text' => 'Text1' ), array( 'value' => 2, 'text' => 'Text2' ) );
		$actual = SelectBoxHelpTester::parseOptions( $expected );

		$this->assertEquals( $expected, $actual );
	}
}

class SelectBoxHelpTester extends SelectBox
{
	public static function isValidValue( $value, $options )
	{
		return parent::isValidValue( $value, $options );
	}

	public static function parseOptions( array $options )
	{
		return parent::parseOptions( $options );
	}
}