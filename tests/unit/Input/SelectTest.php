<?php

use MistyForms\Input\Select;

class SelectTest extends PHPUnit_Framework_TestCase
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
        $select = new Select(array(
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

        $html = str_replace("\n", '', $select->render());

        $this->assertEquals($expected, $html);
    }

    public function testRenderWithValue()
    {
        $select = new Select(array(
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

        $html = str_replace("\n", '', $select->render());

        $this->assertEquals($expected, $html);
    }

    public function testRenderWithValueFromRequest()
    {
        $select = new Select(array(
            'id' => 'selectbox',
            'class' => 'className1 className2',
            'additionalAttr' => 'val',
            'options' => $this->options,
            'selected' => 2
        ), array(
            'selectbox' => 1
        ));
        $select->fromRequest(array(
            'selectbox' => '3'
        ));

        $expected = '<select name="selectbox" id="selectbox" class="className1 className2" additionalAttr="val">';
        $expected .= '<option value="1">val1</option>';
        $expected .= '<option value="2">val2</option>';
        $expected .= '<option value="3" selected="selected">val3</option>';
        $expected .= '</select>';

        $html = str_replace("\n", '', $select->render());

        $this->assertEquals($expected, $html);
    }

    public function testValidateWithInvalidValue()
    {
        $select = new Select(array(
            'id' => 'selectbox',
            'options' => $this->options,
        ), array());
        $select->fromRequest(array(
            'selectbox' => 4
        ));

        $this->assertFalse($select->validate());
    }
}
