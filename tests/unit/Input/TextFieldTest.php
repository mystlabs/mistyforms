<?php

use MistyForms\Input\TextField;

class TextFieldTest extends PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $textField = new TextField(array(
            'id' => 'id',
            'class' => 'className1 className2',
            'additionalAttr' => 'val'
        ), array(
            'id' => 'init-value'
        ));

        $html = $textField->render();
        $expected = '<input type="text" name="id" id="id" value="init-value" class="className1 className2" additionalAttr="val" />';

        $this->assertEquals($expected, $html);
    }

    public function testFromRequest()
    {
        $textField = new TextField(array(
            'id' => 'id',
        ), array());
        $textField->fromRequest(array(
            'id' => 'input-value'
        ));

        $this->assertEquals('input-value', $textField->getData());
    }

    public function testRequired()
    {
        $textField = new TextField(array(
            'id' => 'id',
            'required' => true,
        ), array());
        $textField->fromRequest(array());

        $this->assertFalse($textField->validate());
        $this->assertTrue(strlen($textField->errorMessage) > 0);
    }

    public function testMinLength()
    {
        $textField = new TextField(array(
            'id' => 'id',
            'minLength' => 5,
        ), array());
        $textField->fromRequest(array(
            'id' => 'ciao'
        ));

        $this->assertFalse($textField->validate());
        $this->assertTrue(strlen($textField->errorMessage) > 0);
    }

    public function testMaxLength()
    {
        $textField = new TextField(array(
            'id' => 'id',
            'maxLength' => 10,
        ), array());
        $textField->fromRequest(array(
            'id' => '12345678901'
        ));

        $this->assertFalse($textField->validate());
        $this->assertTrue(strlen($textField->errorMessage) > 0);
    }

    public function testPattern()
    {
        $textField = new TextField(array(
            'id' => 'id',
            'maxLength' => 10,
            'pattern' => '^[a-zA-Z]{5}$',
            'patternMessage' => 'Message!'
        ), array());

        $textField->fromRequest(array(
            'id' => 'abcde'
        ));
        $this->assertTrue($textField->validate());

        $textField->fromRequest(array(
            'id' => 'abcdef'
        ));
        $this->assertFalse($textField->validate());
    }

}