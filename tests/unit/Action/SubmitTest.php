<?php

use MistyForms\Action\Submit;

class SubmitTest extends PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $submit = new Submit(array(
            'id' => 'id',
            'name' => 'not_the_id',
            'class' => 'className1 className2',
            'additionalAttr' => 'val',
            'value' => 'This is the text!'
        ));

        $html = $submit->render();
        $expected = '<input type="submit" name="not_the_id" id="id" value="This is the text!" class="className1 className2" additionalAttr="val" />';

        $this->assertEquals($expected, $html);
    }

    /**
     * @expectedException MistyForms\Exception\ConfigurationException
     */
    public function testMissingValue()
    {
        $submit = new Submit(array(
            'id' => 'id',
            'name' => 'not_the_id',
            'class' => 'className1 className2',
            'additionalAttr' => 'val',
        ));
    }
}
