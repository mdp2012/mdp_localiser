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
 * Adminhtml Controller for dislaying a form for some actions
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.4.0
 */
class Mdp2012_Localiser_LocaliserController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Basic action: setup form
     *
     * @return void
     */
    public function indexAction()
    {
        $helper = Mage::helper('localiser');

        $this->_title($helper->__('System'))
            ->_title($helper->__('Localiser'))
            ->_title($helper->__('Setup'));

        $this->loadLayout()
            ->_setActiveMenu('system/localiser/setup')
            ->_addBreadcrumb($helper->__('Localiser'), $helper->__('Localiser'))
            ->renderLayout();
    }

    /**
     * Recommended extensions
     *
     * @return void
     */
    public function extensionsAction()
    {
        $helper = Mage::helper('localiser');

        $this->_title($helper->__('System'))
            ->_title($helper->__('Localiser'))
            ->_title($helper->__('Recommended Extensions'));

        $this->loadLayout()
            ->_setActiveMenu('system/localiser/extensions')
            ->_addBreadcrumb($helper->__('Localiser'), $helper->__('Localiser'))
            ->renderLayout();
    }

    /**
     * Basic action: setup save action
     *
     * @return void
     */
    public function saveAction()
    {
        $localiserLocale = $this->getRequest()->getParam('localiser_locale');
        if(!is_string($localiserLocale)) {
            throw new Exception('Unexpected format');
        }

        list($localiserCode,$localeCode) = explode('/',$localiserLocale);
        $localiser = Mage::getModel((string)Mage::getConfig()->getNode('default/localiser/locales/'.$localiserCode));
        $localiser->setLocaleCode($localeCode);
        if ($this->getRequest()->isPost()) {
            try {
                if ($this->getRequest()->getParam('systemconfig') == 1) {
                    Mage::getSingleton('localiser/setup_systemconfig')->setLocaliser($localiser)->setup();
                    $this->_getSession()->addSuccess(
                        $this->__('Localiser: System Config Settings have been updated.')
                    );
                }

                if ($this->getRequest()->getParam('cms') == 1) {
                    Mage::getSingleton('localiser/setup_cms')->setLocaliser($localiser)->setup();
                    $this->_getSession()->addSuccess(
                        $this->__('Localiser: CMS Blocks and Pages have been created.')
                    );
                }

                if ($this->getRequest()->getParam('agreements') == 1) {
                    Mage::getSingleton('localiser/setup_agreements')->setLocaliser($localiser)->setup();
                    $this->_getSession()->addSuccess(
                        $this->__('Localiser: Checkout Agreements have been created.')
                    );
                }

                if ($this->getRequest()->getParam('email') == 1) {
                    Mage::getSingleton('localiser/setup_email')->setLocaliser($localiser)->setup();
                    $this->_getSession()->addSuccess(
                        $this->__('Localiser: Email Templates have been created.')
                    );
                }

                if ($this->getRequest()->getParam('tax') == 1) {
                    Mage::getSingleton('localiser/setup_tax')->setLocaliser($localiser)->setup();
                    $this->_getSession()->addSuccess(
                        $this->__('Localiser: Tax Settings have been created.')
                    );

                    $this->_updateProductTaxClasses();
                    $this->_getSession()->addSuccess(
                        $this->__('Localiser: Product Tax Classes have been updated.')
                    );
                }

                // Set a config flag to indicate that the setup has been initialized and refresh config cache.
                Mage::getModel('eav/entity_setup', 'core_setup')->setConfigData('localiser/is_initialized', '1');
                Mage::app()->getCacheInstance()->cleanType('config');
                Mage::dispatchEvent('adminhtml_cache_refresh_type', array('type' => 'config'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*');
    }

    /**
     * Update the old product tax classes to the new tax class ids
     *
     * @return void
     */
    protected function _updateProductTaxClasses()
    {
        $taxClasses = $this->getRequest()->getParam('product_tax_class_target');
        foreach ($taxClasses as $source => $target) {
            if ($target = intval($target)) {
                Mage::getSingleton('localiser/setup_tax')->updateProductTaxClasses($source, $target);
            }
        }

        $this->_markIndicesOutdated();
    }

    /**
     * Mark relevant indices as outdated after chinging tax rates
     *
     * @return void
     */
    protected function _markIndicesOutdated()
    {
        // Indexes which need to be updated after setup
        $indexes = array('catalog_product_price', 'catalog_product_flat', 'catalog_product_attribute');

        $indices = Mage::getModel('index/process')
            ->getCollection()
            ->addFieldToFilter('indexer_code', array('in' => $indexes));

        foreach ($indices as $index) {
            $index->setStatus(Mage_Index_Model_Process::STATUS_REQUIRE_REINDEX)->save();
        }
    }
}
