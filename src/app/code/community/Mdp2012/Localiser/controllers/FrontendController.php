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
class Mdp2012_Localiser_FrontendController extends Mage_Core_Controller_Front_Action
{
    /**
     * Show an agreement
     *
     * @return void
     */
    public function agreementsAction()
    {
        $this->loadLayout();
        if ($id = $this->getRequest()->getParam('id')) {
            /* @var $processor Mage_Cms_Model_Template_Filter */
            $processor = Mage::getModel('cms/template_filter');

            /* @var $agreement Mage_Checkout_Model_Agreement */
            $agreement = Mage::getModel('checkout/agreement')->load($id);

            $headBlock = $this->getLayout()->getBlock('head');
            $headBlock->setTitle(
                $headBlock->htmlEscape($processor->filter($agreement->getCheckboxText()))
            );

            $agreementText = $agreement->getContent();
            if (!$agreement->getIsHtml()) {
                $agreementText = $headBlock->htmlEscape($agreementText);
            }

            $agreeBlock = $this->getLayout()->getBlock('agreement');
            $agreeBlock->setText($processor->filter($agreementText));
        }
        $this->renderLayout();
    }
}
