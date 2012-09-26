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
 * Dummy data helper for translation issues.
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */
class Mdp2012_Localiser_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Generate URL to configured shipping cost page, or '' if none.
     *
     * @return string
     */
    public function getShippingCostUrl()
    {
        /** @var $cmsPage Mage_Cms_Model_Page */
        $cmsPage = Mage::getModel('cms/page')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load(Mage::getStoreConfig('catalog/price/cms_page_shipping'));

        if (!$cmsPage->getId() || !$cmsPage->getIsActive()) {
            return '';
        }

        return Mage::helper('cms/page')->getPageUrl($cmsPage->getId());
    }
}
