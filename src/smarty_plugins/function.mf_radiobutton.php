<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\RadioButton;

function smarty_function_mf_radiobutton($params, $smarty)
{
    $formBlock = FormBlockHelper::fromSmarty($smarty);
    return $formBlock->registerAndRenderInput(new RadioButton($params, $smarty->getTemplateVars()));
}