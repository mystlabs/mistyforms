<?php

require_once __DIR__.'/../smartyintegenv.php';

use MistyForms\Form;
use MistyForms\Handler;

class RenderIntegTest extends MistyForms_SmartyIntegTest
{
	/**
     * @expectedException MistyForms\Exception\ConfigurationException
     */
	public function testRender_missingHandler()
	{
		$this->smarty->fetch( __DIR__ . '/exampleform.tpl' );
	}

	public function testRender_handlerInvokation()
	{
		$handler = new HandlerTestHelper();
		Form::setupForm( $this->smarty, $handler );
		$this->smarty->fetch( __DIR__ . '/exampleform.tpl' );

		$this->assertTrue( $handler->initialized );
		$this->assertFalse( $handler->handledAction1 );
	}

	public function testRender()
	{
		Form::setupForm( $this->smarty, new HandlerTestHelper() );
		$html = $this->smarty->fetch( __DIR__ . '/exampleform.tpl' );

		$xml = new SimpleXmlElement('<xml>'.$html.'</xml>');

		// assert the form exists
		$this->assertNodeExist($xml->form[0]);

		// assert the first label/input exists
		$this->assertNodeExist($xml->form->div[0]->label);
		$this->assertNodeExist($xml->form->div[0]->input);

		// assert the second label/input exists
		$this->assertNodeExist($xml->form->div[1]->label);
		$this->assertNodeExist($xml->form->div[1]->input);

		// assert the buttons exist
		$this->assertNodeExist($xml->form->input[0]);
		$this->assertNodeExist($xml->form->input[1]);
	}
}
