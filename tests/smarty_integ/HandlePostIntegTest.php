<?php

require_once __DIR__.'/../smartyintegenv.php';

use MistyForms\Form;
use MistyForms\Handler;

class HandlePostIntegTest extends MistyForms_SmartyIntegTest
{
	public function testPost_handlerInvokation()
	{
		$_POST = array('action1' => 1);

		$handler = new HandlerTestHelper();
		Form::setupForm( $this->smarty, $handler );
		$this->smarty->fetch( __DIR__ . '/exampleform.tpl' );

		$this->assertTrue( $handler->initialized );
		$this->assertTrue( $handler->handledAction1 );
		$this->assertFalse( $handler->handledAction2 );
		$this->assertNotNull( $handler->formData );
	}

	public function testPost_failedValidation()
	{
		$_POST = array(
			'action1' => 1,
			'numericfield1' => 'not-a-number'
		);

		$handler = new HandlerTestHelper();
		Form::setupForm( $this->smarty, $handler );
		$html =  $this->smarty->fetch( __DIR__ . '/exampleform.tpl' );

		$this->assertTrue( $handler->initialized );
		$this->assertFalse( $handler->handledAction1 );
		$this->assertFalse( $handler->handledAction2 );

		$xml = new SimpleXmlElement('<xml>'.$html.'</xml>');

		// assert the form exists
		$this->assertNodeExist($xml->form[0]->div[2]->div[0]);
	}

	public function testPost()
	{
		$_POST = array(
			'action2' => 1,
			'numericfield1' => '10',
			'textfield1' => 'text-value',
			'fakefield' => 'fake-data'
		);

		$handler = new HandlerTestHelper();
		Form::setupForm( $this->smarty, $handler );
		$this->smarty->fetch( __DIR__ . '/exampleform.tpl' );

		$this->assertTrue( $handler->initialized );
		$this->assertFalse( $handler->handledAction1 );
		$this->assertTrue( $handler->handledAction2 );

		$this->assertEquals(10, $handler->formData['numericfield1']);
		$this->assertEquals('text-value', $handler->formData['textfield1']);
	}

	public function testPost_undefinedFieldsAreNotPassedToHandler()
	{
		$_POST = array(
			'action2' => 1,
			'numericfield1' => '10',
			'textfield1' => 'text-value',
			'fakefield' => 'fake-data'
		);

		$handler = new HandlerTestHelper();
		Form::setupForm( $this->smarty, $handler );
		$this->smarty->fetch( __DIR__ . '/exampleform.tpl' );

		$this->assertTrue(!isset($handler->formData['fakefield']));
	}
}
