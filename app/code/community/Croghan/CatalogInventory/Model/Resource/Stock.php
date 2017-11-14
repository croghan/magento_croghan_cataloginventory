<?php
/**
 * Stock resource model
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 * @author      Michael Croghan <magento@digitalkeg.com>
 */
class Croghan_CatalogInventory_Model_Resource_Stock extends Mage_CatalogInventory_Model_Resource_Stock
{
    /**
     * Define main table and initialize connection
     *
     */
    protected function _construct()
    {
        $this->_init('croghan_cataloginventory/stock', 'stock_id');
    }
}
