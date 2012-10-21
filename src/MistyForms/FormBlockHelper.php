<?php

namespace MistyForms;

class FormBlockHelper
{
    const VIEW_KEY = '_mistyforms_block';

    /**
     * @param \Smarty $smarty
     * @param \MistyForms\FormBlock $formBlock
     */
    public static function toSmarty($smarty, $formBlock)
    {
        $smarty->assign(self::VIEW_KEY, $formBlock);
    }

    /**
     * @param \Smarty $smarty
     * @return \MistyForms\FormBlock
     */
    public static function fromSmarty($smarty)
    {
        $vars = $smarty->getTemplateVars();

        if (!isset($vars[self::VIEW_KEY])) {
            throw new ConfigurationException('The form is missing. This is probably a bug');
        }

        return $vars[self::VIEW_KEY];
    }
}