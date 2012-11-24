<?php

class FormPluginTest extends PHPUnit_Framework_TestCase
{
    public function testOptionalAttribute()
    {
        $formPlugin = new TestFormPlugin(array(
            'attr1' => 'value1',
            'attr2' => 'value2',
            'attr3' => '',
        ));

        $this->assertEquals('value1', $formPlugin->optionalAttribute('attr1', 'def1'));
        $this->assertEquals('default', $formPlugin->optionalAttribute('attr4', 'default'));
        $this->assertEquals('', $formPlugin->optionalAttribute('attr3', 'not-this'));

        $remaining = $formPlugin->getAttributes();
        $this->assertEquals(1, count($remaining));
        $this->assertTrue(isset($remaining['attr2']));
    }

    public function testRequiredAttributeM()
    {
        $formPlugin = new TestFormPlugin(array(
            'attr1' => 'value1',
        ));

        $this->assertEquals('value1', $formPlugin->requiredAttribute('attr1', 'def1'));
        $this->assertEquals(0, count($formPlugin->getAttributes()));
    }

    public function testRequiredAttributeMissing()
    {
        // This is because php 3.6 doesn't allow to expect \Exception... genius!
        try {
            $formPlugin = new TestFormPlugin();
            $formPlugin->requiredAttribute('attr1');
            $this->assertTrue(false); // shouldn't get here
        } catch (\Exception $e) {
            // good
        }
    }
}

class TestFormPlugin extends MistyForms\FormPlugin
{
    public function optionalAttribute($name, $default)
    {
        return parent::optionalAttribute($name, $default);
    }

    public function requiredAttribute($name, $default)
    {
        return parent::optionalAttribute($name, $default);
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function render()
    {
    }
}