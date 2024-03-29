<?php
/**
 * This file is part of the MDP 2012 Hackathon.
 *
 * Mdp2012_Localiser is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.
 *
 * This script is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * PHP version 5
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */
/**
 * Enhanced block for product price display of bundle products. Contains the normal price.phtml
 * rendering and additionally a configured static block.
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */
class Mdp2012_Localiser_Block_Bundle_Catalog_Product_Price extends Mage_Bundle_Block_Catalog_Product_Price
{
    /**
     * Add content of template block below price html if defined in config
     *
     * @return string
     */
    public function _toHtml()
    {
        $html = trim(parent::_toHtml());

        if (empty($html) || !Mage::getStoreConfigFlag('catalog/price/display_block_below_price')) {
            return $html;
        }

        $html .= $this->getLayout()->createBlock('core/template')
            ->setTemplate('localiser/price_info.phtml')
            ->setFormattedTaxRate($this->getFormattedTaxRate())
            ->setIsIncludingTax($this->isIncludingTax())
            ->setIsShowShippingLink($this->isShowShippingLink())
            ->toHtml();

        return $html;
    }

    /**
     * Read tax rate from current product.
     *
     * @return string
     */
    public function getTaxRate()
    {
        if (!$this->getData('tax_rate')) {
            $this->setData('tax_rate', $this->_loadTaxCalculationRate($this->getProduct()));
        }
        return $this->getData('tax_rate');
    }

    /**
     * Retrieves formatted string of tax rate for user output
     *
     * @return string
     */
    public function getFormattedTaxRate()
    {
        if ($this->getTaxRate() === null
            || $this->getProduct()->getTypeId() == 'bundle'
        ) {
            return '';
        }

        $locale  = Mage::app()->getLocale()->getLocaleCode();
        $taxRate = Zend_Locale_Format::toFloat($this->getTaxRate(), array('locale' => $locale));
        return $this->__('%s%%', $taxRate);
    }

    /**
     * Returns whether or not the price contains taxes
     *
     * @return bool
     */
    public function isIncludingTax()
    {
        if (!$this->getData('is_including_tax')) {
            $this->setData('is_including_tax', Mage::getStoreConfig('tax/sales_display/price'));
        }
        return $this->getData('is_including_tax');
    }

    /**
     * Returns whether the shipping link needs to be shown
     * on the frontend or not.
     *
     * @return bool
     */
    public function isShowShippingLink()
    {
        $productTypeId = $this->getProduct()->getTypeId();
        $ignoreTypeIds = array('virtual', 'downloadable');
        if (in_array($productTypeId, $ignoreTypeIds)) {
            return false;
        }
        return true;
    }

    /**
     * Gets tax percents for current product
     *
     * @param Mage_Catalog_Model_Product $product
     * @return string
     */
    protected function _loadTaxCalculationRate(Mage_Catalog_Model_Product $product)
    {
        $taxPercent = $product->getTaxPercent();
        if (is_null($taxPercent)) {
            $taxClassId = $product->getTaxClassId();
            if ($taxClassId) {
                $request    = Mage::getSingleton('tax/calculation')->getRateRequest(null, null, null, null);
                $taxPercent = Mage::getSingleton('tax/calculation')->getRate($request->setProductClassId($taxClassId));
            }
        }

        if ($taxPercent) {
            return $taxPercent;
        }
        return 0;
    }
}
