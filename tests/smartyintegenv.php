<?php

require_once __DIR__ . '/testenv.php';
require_once __DIR__ . '/integ_config/smarty.config.php';

class MistyForms_SmartyIntegTest extends MistyForms_Test
{
    /** @var \Smarty */
	protected $smarty;

	public function setUp()
	{
		$view = new Smarty();

		$view->setTemplateDir(SMARTY_TMP_FOLDER);
		$view->setCompileDir(SMARTY_TMP_FOLDER);
		$view->setConfigDir(SMARTY_TMP_FOLDER);
		$view->setCacheDir(SMARTY_TMP_FOLDER);

		$view->addPluginsDir(__DIR__.'/../src/MistyForms/smarty_plugins/');
		$view->compile_check = true;

		$this->smarty = $view;
	}

	protected function assertNodeExist($node)
	{
		$this->assertTrue((bool)$node);
	}
}

