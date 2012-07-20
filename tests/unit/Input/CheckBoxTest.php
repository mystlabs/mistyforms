<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\CheckBox;

class CheckBoxTest extends MistyForms_Test
{
	public function testRender()
	{
		$textField = new CheckBox(array(
			'id' => 'id',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'checked' => true,
		), array(
			'id' => 'init-value'
		));

		$html = $textField->render();
		$expected = '<input type="checkbox" name="id" id="id" class="className1 className2" checked="checked" additionalAttr="val" />';

		$this->assertEquals($expected, $html);
	}

	public function testFromRequestChecked()
	{
		$textField = new CheckBox(array(
			'id' => 'id',
			'checked' => false
		), array());
		$textField->fromRequest(array(
			'id' => '1'
		));

		$this->assertTrue($textField->getData());
	}

	public function testFromRequestNotChecked()
	{
		$textField = new CheckBox(array(
			'id' => 'id',
			'checked' => true
		), array());
		$textField->fromRequest(array(
			'id' => '0'
		));

		$this->assertFalse($textField->getData());
	}

	public function testRequired()
	{
		$textField = new CheckBox(array(
			'id' => 'id',
			'required' => true,
		), array());
		$textField->fromRequest(array());

		$this->assertFalse($textField->Validate());
		$this->assertTrue(strlen($textField->errorMessage) > 0);
	}
}