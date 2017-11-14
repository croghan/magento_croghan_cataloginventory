<?php
/**
 * Stock item collection resource model
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 * @author      Michael Croghan <magento@digitalkeg.com>
 */
class Croghan_CatalogInventory_Model_Resource_Stock_Item_Collection extends Mage_CatalogInventory_Model_Resource_Stock_Item_Collection
{
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('croghan_cataloginventory/stock_item');
    }
}
