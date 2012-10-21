<?php

use MistyForms\FormBlockHelper;
use MistyForms\Input\Select;

function smarty_function_mf_select($params, $smarty)
{
    $formBlock = FormBlockHelper::fromSmarty($smarty);
    return $formBlock->registerAndRenderInput(new Select($params, $smarty->getTemplateVars()));
}