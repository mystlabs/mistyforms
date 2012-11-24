<?php

use MistyForms\Input\TextArea;

class TextAreaTest extends PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $textArea = new TextArea(array(
            'id' => 'id',
            'class' => 'className1 className2',
            'additionalAttr' => 'val'
        ), array(
            'id' => 'init-value'
        ));

        $html = $textArea->render();
        $expected = '<textarea name="id" id="id" class="className1 className2" additionalAttr="val">init-value</textarea>';

        $this->assertEquals($expected, $html);
    }
}