<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\EmailField;

class EmailFieldTest extends MistyForms_Test
{
	public function testRender()
	{
		$textField = new EmailField(array(
			'id' => 'id',
			'class' => 'className1 className2',
			'additionalAttr' => 'val'
		), array(
			'id' => 'init-value'
		));

		$html = $textField->render();
		$expected = '<input type="email" name="id" id="id" value="init-value" class="className1 className2" additionalAttr="val" />';

		$this->assertEquals($expected, $html);
	}

	public function testIsValidEmail()
	{
		$this->checkEmail( 'example@domain.org', true );
		$this->checkEmail( 'example@domain.org.com', true );
		$this->checkEmail( 'example.example@domain.org', true );

		$this->checkEmail( 'example@domain', false );
		$this->checkEmail( '@domain.org', false );
		$this->checkEmail( 'example@domain@domain.org', false );
		$this->checkEmail( 'example.domain.org', false );
	}

	private function checkEmail( $email, $expectValid )
	{
		$numericField = new EmailField(array('id' => 'email'), array());
		$numericField->fromRequest(array(
			'email' => $email
		));

		if( $expectValid )
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