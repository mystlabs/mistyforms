<?php

require_once __DIR__ . '/../testenv.php';

use MistyForms\FormBlock;
use MistyForms\Form;

class FormBlockTest extends MistyForms_Test
{
    public function testRender()
    {
        $form = new Form(new NullHandler(), null);
        $formBlock = new FormBlock($form, array(
            'id' => 'formid',
            'additionalAttr' => 'val'
        ));

        $content = '<-- HTML content should be preserved -->';
        $html = $formBlock->renderWithContent($content);
        $expected = '<form action="" method="POST" class="mf_form" id="formid" additionalAttr="val">' . $content . '</form>';

        $this->assertEquals($expected, $html);
    }

    public function testRenderWithCustomClass()
    {
        $form = new Form(new NullHandler(), null);
        $formBlock = new FormBlock($form, array(
            'id' => 'formid',
            'class' => 'className1 className2',
            'additionalAttr' => 'val'
        ));

        $content = '<-- HTML content should be preserved -->';
        $html = $formBlock->renderWithContent($content);
        $expected = '<form action="" method="POST" class="mf_form className1 className2" id="formid" additionalAttr="val">' . $content . '</form>';

        $this->assertEquals($expected, $html);
    }
}