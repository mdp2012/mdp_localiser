Changes to Firegento GermanSetup

Localiser extensions are expected to define a class in their config.xml file

    <default>
        <localiser>
            <locales>
                <LOCALISER_CODE>Model string to retrieve Localiser</LOCALISER_CODE>
            </locales>
        </localiser>
    </default>

The Localiser is expected to be a child of Mdp2012_Localiser_Model_Localiser_Abstract.

By default a localiser xml file is loaded from MODULE_DIR/etc/localiser/LOCALENAME.xml
This can be adjusted by extending Mdp2012_Localiser_Model_Localiser_Abstract::getConfigData()
to for example load 'de' first before then loading 'de_DE' and 'de_AT'

The layout of the loaded configuration has also changed slightly:
1.) Removal of default nodes under each category.
2.) All categories are instead found under a locale node

OLD
<?xml version="1.0"?>
<config>
    <default>
        <LOCALISER_CODE>
            <tax_calculation_rules>
                <default>


NEW

<?xml version="1.0"?>
<config>
    <default>
        <localiser>
            <LOCALISER_CODE>
                <xx_ZZ>
                    <tax_calculation_rules>


