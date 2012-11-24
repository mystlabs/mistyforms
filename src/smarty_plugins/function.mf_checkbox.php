<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\CheckBox;

function smarty_function_mf_checkbox($params, $smarty)
{
    $formBlock = FormBlockHelper::fromSmarty($smarty);
    return $formBlock->registerAndRenderInput(new CheckBox($params, $smarty->getTemplateVars()));
}