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
 * @since     0.4.0
 */
/**
 * Displays a form with some options to setup things
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.4.0
 */
class Mdp2012_Localiser_Block_Adminhtml_Localiser extends Mage_Adminhtml_Block_Widget
{
    /**
     * Class Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Localiser');
    }

    /**
     * Retrieve the POST URL for the form
     *
     * @return string URL
     */
    public function getPostActionUrl()
    {
        return $this->getUrl('*/*/save');
    }

    /**
     * Get old product tax classes
     *
     * @return array
     */
    public function getProductTaxClasses()
    {
        return Mage::getSingleton('tax/class_source_product')->getAllOptions();
    }

    /**
     * Get new product tax classes (yet to be created)
     *
     * @return array
     */
    public function getNewProductTaxClasses()
    {
        return Mage::getSingleton('localiser/source_tax_newProductTaxClass')->getAllOptions();
    }

    /**
     * @return int default new tax class (yet to be created)
     */
    public function getDefaultProductTaxClass()
    {
        return Mage::getSingleton('localiser/source_tax_newProductTaxClass')->getDefaultOption();
    }


    public function getLocaleChoices()
    {
        return array(
            array('code'=>'de', 'name' => $this->__('Germany')),
            array('code'=>'at', 'name'=> $this->__('Austria')),
            array('code'=>'ch', 'name' => $this->__('Switzerland'))
        );
    }
}
