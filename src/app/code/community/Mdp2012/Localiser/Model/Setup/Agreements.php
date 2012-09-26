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
 * Setup class for Checkout Agreements
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.5.0
 */
class Mdp2012_Localiser_Model_Setup_Agreements extends Mdp2012_Localiser_Model_Setup_Abstract
{
    /**
     * Setup Checkout Agreements
     *
     * @return void
     */
    public function setup()
    {
        // Build and create agreements
        $agreements = array(
/** @JDS TODO add countries */
        );
        foreach ($agreements as $agreement) {
            $model = Mage::getModel('checkout/agreement');
            $model = $this->_loadExistingModel($model, 'name', $agreement['name']);
            $model->addData($agreement);
            $model->save();
        }

        // Set config value to true
        $setup = Mage::getModel('eav/entity_setup', 'core_setup');
        $setup->setConfigData('checkout/options/enable_agreements', '1');
    }
}
