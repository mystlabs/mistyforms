<?php

require_once __DIR__ . '/../../testenv.php';

class InputTest extends MistyForms_Test
{
    public function testIdIsRequired()
    {
        // This is because php 3.6 doesn't allow to expect \Exception... genius!
        try {
            $formPlugin = new TestInput(array(), array());
            $this->assertTrue(false); // shouldn't get here
        } catch (\Exception $e) {
            // good
        }
    }

    public function testIsReadOnly()
    {
        $emptyArray = array();

        $formPlugin = new TestInput(array(
            'id' => 'test',
            'readOnly' => true,
        ), $emptyArray);
        $formPlugin->fromRequest($emptyArray);
        $formPlugin->getData();
    }
}

class TestInput extends MistyForms\Input\Input
{
    protected function fromView(array $templateVars)
    {
    }

    protected function _fromRequest(array $requestParams)
    {
        throw new \Exception('Should not have been called - read only');
    }

    protected function _getData()
    {
        throw new \Exception('Should not have been called - read only');
    }

    public function validate()
    {
    }

    public function render()
    {
    }
}