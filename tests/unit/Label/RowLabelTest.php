<?php

require_once __DIR__.'/../../testenv.php';

use MistyForms\Input\TextField;
use MistyForms\Label\RowLabel;

class RowLabelTest extends MistyForms_Test
{
	public function testRender()
	{
		$content = '<!-- HTML content ->';
		$label = new RowLabel(array(
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'text' => 'Text'
		), $content);

		$html = $label->render();
		$expected = '<div class="mf_formrow className1 className2" additionalAttr="val"><label>Text</label>'.$content.'</div>';

		$this->assertEquals($expected, $html);
	}

	public function testRenderWithInput()
	{
		$input = new TextField(array(
			'required' => 1,
			'id' => 'inputid'
		), array());
		$input->errorMessage = 'Test error';

		$content = '<!-- HTML content ->';
		$label = new RowLabel(array(
			'class' => 'className1 className2',
			'additionalAttr' => 'val',
			'text' => 'Text'
		), $content);
		$label->setInput($input);

		$html = $label->render();
		$expected = '<div class="mf_formrow mf_required mf_invalid className1 className2" additionalAttr="val">'
			. '<label for="inputid">Text</label>' . $content
			. '<div class="mf_errormessage">Test error</div></div>';

		$this->assertEquals($expected, $html);
	}
}