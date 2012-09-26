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
 * Setup class
 *
 * @category  Mdp2012
 * @package   Mdp2012_Localiser
 * @author    Mdp2012 Team <team@magento-developer-paradise.com>
 * @copyright 2012 Mdp2012 Team (http://gitorious.mdp/mdp_localiser). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.2.0
 */
class Mdp2012_Localiser_Model_Setup_Abstract extends Mage_Core_Model_Abstract
{
    /**
     * Get config.xml data
     *
     * @return array
     */
    public function getConfigData()
    {
        $configData = Mage::getSingleton('localiser/config')
            ->getNode('default/localiser')
            ->asArray();
        return $configData;
    }

    /**
     * Get config.xml data
     *
     * @param string      $node      xml node
     * @param string|null $childNode if set, child node of the first node
     *
     * @return array
     */
    protected function _getConfigNode($node, $childNode = null)
    {
        $configData = $this->getConfigData();
        if ($childNode) {
            return $configData[$node][$childNode];
        } else {
            return $configData[$node];
        }
    }

    /**
     * Get template content
     *
     * @param string $filename template file name
     *
     * @return string
     */
    public function getTemplateContent($filename)
    {
        return file_get_contents(Mage::getBaseDir() . DS . $filename);
    }

    /**
     * Load a model by attribute code
     *
     * @param Mage_Core_Model_Abstract $model
     * @param string $attributeCode
     * @param string $value
     * @return Mage_Core_Model_Abstract
     */
    protected function _loadExistingModel($model, $attributeCode, $value)
    {
        foreach ($model->getCollection() as $singleModel) {
            if ($singleModel->getData($attributeCode) == $value) {
                $model->load($singleModel->getId());
                return $model;
            }
        }
        return $model;
    }
}
