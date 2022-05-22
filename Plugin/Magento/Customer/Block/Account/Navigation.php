<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2020 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
namespace Jajuma\CustomerNavigation\Plugin\Magento\Customer\Block\Account;

use Jajuma\CustomerNavigation\Helper\Data;
use Magento\Customer\Block\Account\SortLinkInterface;
use Magento\Framework\View\Element\Template;

/**
 * Class Navigation
 * @package Jajuma\CustomerNavigation\Plugin\Magento\Customer\Block\Account
 */
class Navigation extends \Magento\Customer\Block\Account\Navigation
{

    /**
     * @var Data
     */
    protected $helper;

    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Customer\Block\Account\Navigation $subject
     * @param $result
     * @return mixed
     */
    public function afterGetLinks(\Magento\Customer\Block\Account\Navigation $subject, $result)
    {

        if ($this->helper->isEnabled() && $subject->getNameInLayout() == 'customer_account_navigation') {
            $customResult = $resultNew = [];
            /* @var \Magento\Customer\Block\Account\Link $link */
            foreach ($result as $key => $link) {
                if ($this->isShow($link)) {
                    $customResult[$link->getData('sortOrder')] = $link;
                }
            }

            ksort($customResult);
            return $customResult;
        }
        return $result;
    }

    /**
     * @param $link
     * @return bool|mixed
     */
    public function isShow(&$link)
    {

        if ($this->helper->getConfig('show_3rd_party_links') == 0) : {
            $show = false;
        }
        else : {
            $show = true;
        }
        endif;

	    $sortorder = $link->getsortOrder();
        switch ($link->getPath()) {
            case 'customer/account':
                $link->setData('sortOrder', $this->helper->getConfig('position_account'));
                $show = $this->helper->getConfig('show_account');
                break;
            case 'sales/order/history':
                $link->setData('sortOrder', $this->helper->getConfig('position_orders'));
                $show = $this->helper->getConfig('show_orders');
                break;
            case 'downloadable/customer/products':
                $link->setData('sortOrder', $this->helper->getConfig('position_downloadable_products'));
                $show = $this->helper->getConfig('show_downloadable_products');
                break;
            case 'wishlist':
                $link->setData('sortOrder', $this->helper->getConfig('position_wishlist'));
                $show = $this->helper->getConfig('show_wishlist');
                break;
            case 'customer/address':
                $link->setData('sortOrder', $this->helper->getConfig('position_address_book'));
                $show = $this->helper->getConfig('show_address_book');
                break;
            case 'customer/account/edit':
                $link->setData('sortOrder', $this->helper->getConfig('position_account_edit'));
                $show = $this->helper->getConfig('show_account_edit');
                break;
            case 'vault/cards/listaction':
                $link->setData('sortOrder', $this->helper->getConfig('position_cards'));
                $show = $this->helper->getConfig('show_cards');
                break;
            case 'paypal/billing_agreement':
                $link->setData('sortOrder', $this->helper->getConfig('position_billing_agreements'));
                $show = $this->helper->getConfig('show_billing_agreements');
                break;
            case 'review/customer':
                $link->setData('sortOrder', $this->helper->getConfig('position_reviews'));
                $show = $this->helper->getConfig('show_reviews');
                break;
            case 'newsletter/manage':
                $link->setData('sortOrder', $this->helper->getConfig('position_newsletter'));
                $show = $this->helper->getConfig('show_newsletter');
                break;
            case '':
                if ($sortorder == '0') :  {
                $link->setData('sortOrder', $this->helper->getConfig('position_hyva_logout'));
                }
                elseif ($sortorder == '10') :  {
                $link->setData('sortOrder', $this->helper->getConfig('position_hyva_divider_1'));
                $show = 0;
                }
                elseif ($sortorder == '130') :  {
                $link->setData('sortOrder', $this->helper->getConfig('position_divider_1'));
                $show = 0;
                }
                elseif ($sortorder == '200') :  {
                $link->setData('sortOrder', $this->helper->getConfig('position_divider_2'));
                $show = 0;
                }
                elseif ($sortorder == $this->helper->getConfig('position_hyva_logout')) :  {
                $show = $this->helper->getConfig('show_hyva_logout');
                }
                elseif ($sortorder == $this->helper->getConfig('position_hyva_divider_1')) :  {
                $show = $this->helper->getConfig('show_hyva_divider_1');
                }
                elseif ($sortorder == $this->helper->getConfig('position_divider_1')) :  {
                $show = $this->helper->getConfig('show_divider_1');
                }
                elseif ($sortorder == $this->helper->getConfig('position_divider_2')) :  {
                $show = $this->helper->getConfig('show_divider_2');
                }
                endif;
               break;
            case $this->helper->getConfig('link_custom_1'):
                $link->setData('sortOrder', $this->helper->getConfig('position_custom_1'));
                $show = $this->helper->getConfig('show_custom_1');
                break;
            case $this->helper->getConfig('link_custom_2'):
                $link->setData('sortOrder', $this->helper->getConfig('position_custom_2'));
                $show = $this->helper->getConfig('show_custom_2');
                break;
            case $this->helper->getConfig('link_custom_3'):
                $link->setData('sortOrder', $this->helper->getConfig('position_custom_3'));
                $show = $this->helper->getConfig('show_custom_3');
                break;
            case $this->helper->getConfig('link_custom_4'):
                $link->setData('sortOrder', $this->helper->getConfig('position_custom_4'));
                $show = $this->helper->getConfig('show_custom_4');
                break;
        }
        return $show;
    }
}