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
 * @since     0.2.0
 */
/**
 * Setup class for transaction emails
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.5.0
 */
class Mdp2012_Localiser_Model_Setup_Email extends Mdp2012_Localiser_Model_Setup_Abstract
{
    /**
     * Setup Transaction Emails
     *
     * @return void
     */
    public function setup()
    {
        // execute emails
        foreach ($this->_getConfigEmails() as $data) {
            if ($data['execute'] == 1) {
                $this->_createEmail($data, false);
            }
        }
    }

    /**
     * Get emails/default from config file
     *
     * @return array
     */
    protected function _getConfigEmails()
    {
        return $this->_getConfigNode('emails');
    }

    /**
     * Create transactional email template
     *
     * @param array $emailData template data
     * @param boolean $override override email template if set
     *
     * @return void
     */
    protected function _createEmail($emailData, $override = true)
    {
        $template = Mage::getModel('core/email_template')
            ->loadByCode($emailData['template_code']);

        if (!$template->getId() || $override) {
            $template->setTemplateSubject($emailData['template_subject'])
                ->setTemplateCode($emailData['template_code'])
                ->setTemplateText($this->getTemplateContent($emailData['text']))
                ->setTemplateType($emailData['template_type'])
                ->setModifiedAt(Mage::getSingleton('core/date')->gmtDate())
                ->save();
        }

        $this->setConfigData($emailData['config_data_path'], $template->getId());
    }
}

