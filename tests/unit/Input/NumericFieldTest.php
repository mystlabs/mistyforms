<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\NumericField;

class NumericFieldTest extends MistyForms_Test
{
	public function testMinValue()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'minValue' => 18
		), array());
		$numericField->fromRequest(array(
			'id' => '10'
		));

		$this->assertFalse($numericField->validate());
		$this->assertTrue(strlen($numericField->errorMessage) > 0);
	}

	public function testGetValue()
	{
		$numericField = new NumericField(array(
			'id' => 'id'
		), array());
		$numericField->fromRequest(array(
			'id' => '10'
		));

		$this->assertEquals(10, $numericField->getData());
		$this->assertTrue($numericField->getData() === 10 );
	}

	public function testFormat()
	{
		$this->checkFormat( 'numeric', '500', true );
		$this->checkFormat( 'numeric', '5.5', true );
		$this->checkFormat( 'numeric', '5,5', false );
		$this->checkFormat( 'numeric', '+50', true );
		$this->checkFormat( 'numeric', '-50', true );
		$this->checkFormat( 'numeric', '$50', false );

		$this->checkFormat( 'integer', '500', true );
		$this->checkFormat( 'integer', '5.5', false );
		$this->checkFormat( 'integer', '5,5', false );
		$this->checkFormat( 'integer', '+50', true );
		$this->checkFormat( 'integer', '-50', true );
		$this->checkFormat( 'integer', '$50', false );

		$this->checkFormat( 'float', '500', true );
		$this->checkFormat( 'float', '5.5', true );
		$this->checkFormat( 'float', '5,5', false );
		$this->checkFormat( 'float', '+50', true );
		$this->checkFormat( 'float', '-50', true );
		$this->checkFormat( 'float', '$50', false );

		$this->checkFormat( 'integerorfloat', '500', true );
		$this->checkFormat( 'integerorfloat', '5.5', true );
		$this->checkFormat( 'integerorfloat', '5,5', false );
		$this->checkFormat( 'integerorfloat', '+50', true );
		$this->checkFormat( 'integerorfloat', '-50', true );
		$this->checkFormat( 'integerorfloat', '$50', false );
	}

	public function testMinValueZero()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'minValue' => 0
		), array());
		$numericField->fromRequest(array(
			'id' => '-10'
		));

		$this->assertFalse($numericField->validate());
		$this->assertTrue(strlen($numericField->errorMessage) > 0);
	}

	public function testMinValueButNotRequired()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'minValue' => 18
		), array());
		$numericField->fromRequest(array(
			'id' => ''
		));

		$this->assertTrue($numericField->validate());
	}

	public function testMinValueAndRequired()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'minValue' => 18,
			'required' => true
		), array());
		$numericField->fromRequest(array(
			'id' => ''
		));

		$this->assertFalse($numericField->validate());
		$this->assertTrue(strlen($numericField->errorMessage) > 0);
	}

	public function testMaxValue()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'maxValue' => 18
		), array());
		$numericField->fromRequest(array(
			'id' => '20'
		));

		$this->assertFalse($numericField->validate());
		$this->assertTrue(strlen($numericField->errorMessage) > 0);
	}

	public function testMaxValueZero()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'maxValue' => 0
		), array());
		$numericField->fromRequest(array(
			'id' => '5'
		));

		$this->assertFalse($numericField->validate());
		$this->assertTrue(strlen($numericField->errorMessage) > 0);
	}

	public function testMaxValueButNotRequired()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'maxValue' => 18
		), array());
		$numericField->fromRequest(array(
			'id' => ''
		));

		$this->assertTrue($numericField->validate());
	}

	public function testMaxValueAndRequired()
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'maxValue' => 18,
			'required' => true
		), array());
		$numericField->fromRequest(array(
			'id' => ''
		));

		$this->assertFalse($numericField->validate());
		$this->assertTrue(strlen($numericField->errorMessage) > 0);
	}

	private function checkFormat( $format, $value, $expectedValid )
	{
		$numericField = new NumericField(array(
			'id' => 'id',
			'format' => $format,
			'required' => true
		), array());
		$numericField->fromRequest(array(
			'id' => $value
		));

		if( $expectedValid )
		{
			$this->assertTrue($numericField->validate());
		}
		else
		{
			$this->assertFalse($numericField->validate());
			$this->assertTrue(strlen($numericField->errorMessage) > 0);
		}
	}
}