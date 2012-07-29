<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\RadioButton;

class RadioButtonTest extends MistyForms_Test
{
	private $options;

	public function setup()
	{
		$this->options = array(
			0 => 'val1',
			1 => 'val2',
			2 => 'val3',
		);
	}

	public function testRenderChecked()
	{
		$radio = new RadioButton(array(
			'id' => 'rbtest',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'checked' => 1
		), array());

		$expected = '<div class="mf_options className1 className2" additionalAttr="val">';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_0" value="0" /><label for="rbtest_rb_0">val1</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_1" value="1" checked="checked" /><label for="rbtest_rb_1">val2</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_2" value="2" /><label for="rbtest_rb_2">val3</label></span>';
		$expected .= '</div>';

		$html = str_replace( "\n", '', $radio->render() );

		$this->assertEquals($expected, $html);
	}

	public function testRenderWithValue()
	{
		$radio = new RadioButton(array(
			'id' => 'rbtest',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'checked' => 1
		), array(
			'rbtest' => 0
		));

		$expected = '<div class="mf_options className1 className2" additionalAttr="val">';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_0" value="0" checked="checked" /><label for="rbtest_rb_0">val1</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_1" value="1" /><label for="rbtest_rb_1">val2</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_2" value="2" /><label for="rbtest_rb_2">val3</label></span>';
		$expected .= '</div>';

		$html = str_replace( "\n", '', $radio->render() );

		$this->assertEquals($expected, $html);
	}

	public function testRenderWithNoValue()
	{
		$radio = new RadioButton(array(
			'id' => 'rbtest',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'checked' => 1
		), array(
			'rbtest' => ''
		));

		$expected = '<div class="mf_options className1 className2" additionalAttr="val">';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_0" value="0" /><label for="rbtest_rb_0">val1</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_1" value="1" /><label for="rbtest_rb_1">val2</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_2" value="2" /><label for="rbtest_rb_2">val3</label></span>';
		$expected .= '</div>';

		$html = str_replace( "\n", '', $radio->render() );

		$this->assertEquals($expected, $html);
	}

	public function testRenderWithValueFromRequest()
	{
		$radio = new RadioButton(array(
			'id' => 'rbtest',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'checked' => 1
		), array(
			'rbtest' => ''
		));
		$radio->fromRequest(array(
			'rbtest' => '2'
		));

		$expected = '<div class="mf_options className1 className2" additionalAttr="val">';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_0" value="0" /><label for="rbtest_rb_0">val1</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_1" value="1" /><label for="rbtest_rb_1">val2</label></span>';
		$expected .= '<span><input type="radio" name="rbtest" id="rbtest_rb_2" value="2" checked="checked" /><label for="rbtest_rb_2">val3</label></span>';
		$expected .= '</div>';

		$html = str_replace( "\n", '', $radio->render() );

		$this->assertEquals($expected, $html);
	}

	public function testValidateWithInvalidValue()
	{
		$radio = new RadioButton(array(
			'id' => 'rbtest',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'options' => $this->options,
			'checked' => 1
		), array());
		$radio->fromRequest(array(
			'rbtest' => 4
		));

		$this->assertFalse($radio->validate());
	}
}