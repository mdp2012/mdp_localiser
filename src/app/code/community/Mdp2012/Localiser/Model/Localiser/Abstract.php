<?php

abstract class Mdp2012_Localiser_Model_Localiser_Abstract implements Mdp2012_Localiser_Model_Interface
{
    private $_localeCode;

    public function setLocaleCode($localeCode)
    {
        $this->_localeCode = $localeCode;
        return $this;
    }

    public function getLocaleCode()
    {
        return $this->_localeCode;
    }

    /**
     * return the locale code
     * @return array
     */
    public function getSupportedLocaleCodes() {

    }

    /**
     * return the tax configuration of locale
     * @return
     */
    public function getTaxConfiguration()
    {

    }

    public function getAgreements()
    {

    }

    public function getCmsPages()
    {

    }

    public function getCmsBlocks()
    {

    }

    public function getEmailTemplates()
    {

    }

    public function getSystemConfigurations()
    {

    }

    public function getTaxConfig() {

    }

    public function getTaxCalcRules()
    {

    }

    public function getTaxCalcRates()
    {

    }

    public function getTaxCalculations()
    {

    }

}
