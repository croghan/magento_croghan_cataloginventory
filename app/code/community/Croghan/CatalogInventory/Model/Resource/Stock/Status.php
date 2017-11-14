<?php
/**
 * CatalogInventory Stock Status per website Resource Model
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 * @author      Michael Croghan <magento@digitalkeg.com>
 */
class Croghan_CatalogInventory_Model_Resource_Stock_Status extends Mage_CatalogInventory_Model_Resource_Stock_Status
{
    /**
     * Define main table and initialize connection
     *
     */
    protected function _construct()
    {
        $this->_init('croghan_cataloginventory/stock_status', 'product_id');
    }
}
