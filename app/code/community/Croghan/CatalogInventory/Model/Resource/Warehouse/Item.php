<?php
/**
 * Warehouse Item resource model
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 * @author      Michael Croghan <magento@digitalkeg.com>
 */
class Croghan_CatalogInventory_Model_Resource_Warehouse_Item extends Mage_Core_Model_Resource_Abstract
{
    /**
     * Define main table and initialize connection
     *
     */
    protected function _construct()
    {
        $this->_init('croghan_cataloginventory/warehouse_item', 'item_id');
    }
}
