<?php

namespace MistyForms\Test;

class SmartyIntegTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Smarty */
    protected $smarty;

    public function setUp()
    {
        $view = new \Smarty();

        $view->setTemplateDir(SMARTY_TMP_FOLDER);
        $view->setCompileDir(SMARTY_TMP_FOLDER);
        $view->setConfigDir(SMARTY_TMP_FOLDER);
        $view->setCacheDir(SMARTY_TMP_FOLDER);

        $view->addPluginsDir(__DIR__.'/../../smarty_plugins/');
        $view->compile_check = true;

        $this->smarty = $view;
    }

    protected function assertNodeExist($node)
    {
        $this->assertTrue((bool)$node);
    }
}