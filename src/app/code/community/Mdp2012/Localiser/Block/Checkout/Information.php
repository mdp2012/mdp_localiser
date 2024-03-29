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
 * Block to enable ip anonymization for german tracking.
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */
class Mdp2012_Localiser_Block_Checkout_Information extends Mage_Core_Block_Template
{
    /**
     * @var string
     */
    const XML_PATH_CHECKOUT_DISPLAY_ADDITIONAL_INFORMATION = 'checkout/options/display_additional_information';

    /**
     * @var string
     */
    const XML_PATH_CHECKOUT_ADDITIONAL_INFORMATION = 'checkout/options/additional_information';

    /**
     * Retrieve the additional information for the review page
     *
     * @return string|boolean
     */
    public function getCheckoutAdditionalInformation()
    {
        if (!Mage::getStoreConfigFlag(self::XML_PATH_CHECKOUT_DISPLAY_ADDITIONAL_INFORMATION)) {
            return false;
        }

        $additional = Mage::getStoreConfig(self::XML_PATH_CHECKOUT_ADDITIONAL_INFORMATION);
        $additional = trim($additional);

        if ($additional) {
            return $additional;
        }
        return false;
    }
}
