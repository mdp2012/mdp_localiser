<?php

abstract class Mdp2012_Localiser_Model_Localiser_Abstract
{
    private $_localeCode;

    /**
     * set the locale code to be worked on
     * @param string $localeCode
     * @return Mdp2012_Localiser_Model_Localiser_Abstract
     */
    public function setLocaleCode($localeCode)
    {
        $this->_localeCode = $localeCode;
        return $this;
    }

    /**
     * retrieve the current locale code to process
     * @return string
     */
    public function getLocaleCode()
    {
        return $this->_localeCode;
    }

    /**
     * retrieve code of this localiser
     *
     * @return string
     */
    abstract function getCode();

    /**
     * retrieve the name of this module
     *
     * @return string
     */
    abstract function getModuleName();

    /**
     * return the locale codes supported by this localiser
     *
     * @return array
     */
    abstract public function getSupportedLocaleCodes();

    /**
     * loads config data from instantiated localiser module directory
     * and returns the localiser config data as array
     *
     * @return array
     */
    public function getConfigData()
    {
        //TODO: make sure this is only loaded once
        $localiserConfig = Mage::getSingleton('localiser/config');
        $localiserConfig->addConfigFile($this->getModuleName(), 'localiser/'.$this->getLocaleCode().'.xml');
        $configData = $localiserConfig
            ->getNode('default/localiser/'.$this->getCode().'/'.$this->getLocaleCode())
            ->asArray();
        return $configData;
    }
}
