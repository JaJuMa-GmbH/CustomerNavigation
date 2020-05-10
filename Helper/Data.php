<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2020 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\CustomerNavigation\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Data
 * @package Jajuma\CustomerNavigation\Helper
 */
class Data extends AbstractHelper
{

    /**
     * Data constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (boolean) $this->scopeConfig->getValue('jajuma_customer_navigation/general/enabled');
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getConfig($field)
    {
        $settings = $this->scopeConfig->getValue('jajuma_customer_navigation/settings');
        return $settings[$field];
    }

}