<?php
/**
 * Warehouse Item collection resource model
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 * @author      Michael Croghan <magento@digitalkeg.com>
 */
class Croghan_CatalogInventory_Model_Resource_Warehouse_Item_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('croghan_cataloginventory/warehouse_item');
    }
}
