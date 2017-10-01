<?php

namespace Mager\Joiner\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Path to Enabled setting
     */
    const XML_PATH_ENABLED = 'mager_joiner/general/enabled';

    /**
     * Whether the module is enabled or disabled
     * 
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ENABLED);
    }
}