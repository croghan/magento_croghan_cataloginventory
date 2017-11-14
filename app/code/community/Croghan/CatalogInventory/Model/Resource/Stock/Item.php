<?php
/**
 * Stock item resource model
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 * @author      Michael Croghan <magento@digitalkeg.com>
 */
class Croghan_CatalogInventory_Model_Resource_Stock_Item extends Mage_CatalogInventory_Model_Resource_Stock_Item
{
    /**
     * Define main table and initialize connection
     *
     */
    protected function _construct()
    {
        $this->_init('croghan_cataloginventory/stock_item', 'item_id');
    }
}