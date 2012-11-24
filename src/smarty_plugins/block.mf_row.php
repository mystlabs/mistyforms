<?php

use MistyForms\FormBlockHelper;
use MistyForms\Label\Row;

function smarty_block_mf_row($params, $content, $smarty, &$isOpeningTag)
{
    // we don't have anything to do when the block is open
    if ($isOpeningTag) return '';

    $inputId = false;
    if (isset($params['for'])) {
        $inputId = $params['for'];
        unset($params['for']);
    }

    if (isset($params['label'])) {
        $params['text'] = $params['label'];
        unset($params['label']);
    }

    $formBlock = FormBlockHelper::fromSmarty($smarty);
    return $formBlock->registerAndRenderLabel(new Row($params, $content), $inputId);
}
