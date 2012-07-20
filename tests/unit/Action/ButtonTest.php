<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Action\Button;

class ButtonTest extends MistyForms_Test
{
	public function testRender()
	{
		$submit = new Button(array(
			'id' => 'id',
			'name' => 'not_the_id',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
		), 'This is the content!');

		$html = $submit->render();
		$expected = '<button name="not_the_id" id="id" class="className1 className2" additionalAttr="val">This is the content!</button>';

		$this->assertEquals($expected, $html);
	}

	/**
     * @expectedException MistyForms\Exception\ConfigurationException
     */
	public function testMissingContent()
	{
		$submit = new Button(array(
			'id' => 'id',
			'name' => 'not_the_id',
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
		), '');
	}
}
