<?php

namespace MistyForms;

use MistyForms\Exception\ConfigurationException;
use MistyForms\Handler;

class HandlerHelper
{
    const VIEW_KEY = '_mistyforms_handler';

    /**
     * Static function to save the handler in the view
     *
     * @param \Smarty $smarty
     * @param \MistyForms\Handler $handler
     */
    public static function toSmarty($smarty, Handler $handler)
    {
        $smarty->assign(self::VIEW_KEY, $handler);
    }

    /**
     * Static function to retrieve the handler from the view
     *
     * @param \Smarty $smarty
     * @return \MistyForms\Handler
     */
    public static function fromSmarty($smarty)
    {
        $vars = $smarty->getTemplateVars();

        if (!isset($vars[self::VIEW_KEY])) {
            throw new ConfigurationException('The form handler is missing. Did you call Form::setupForm()?');
        }

        $handler = $vars[self::VIEW_KEY];
        if (!$handler instanceof Handler) {
            throw new ConfigurationException('The handler is not of type MistyForms\Handler');
        }

        return $handler;
    }
}