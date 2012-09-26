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
     * Config class
     *
     * @category  Mdp2012
     * @package   Mdp2012_Localiser
     * @author    Mdp2012 Team <team@magento-developer-paradise.com>
     * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
     * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
     * @version   $Id:$
     * @since     0.2.0
     */
interface Mdp2012_Localiser_Model_Interface
{
    /**
     * return the locale code
     * @return array
     */
    public function getSupportedLocaleCodes();

    /**
     * return the tax configuration of locale
     * @return 
     */
    public function getTaxConfiguration();

    public function getAgreements();

    public function getCmsPages();

    public function getCmsBlocks();

    public function getEmailTemplates();

    public function getSystemConfigurations();

    public function getTaxConfig();

    public function getTaxCalcRules();

    public function getTaxCalcRates();

    public function getTaxCalculations();

}
