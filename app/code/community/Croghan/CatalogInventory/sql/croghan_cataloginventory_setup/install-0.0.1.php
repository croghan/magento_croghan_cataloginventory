<?php
/**
 * Installer
 *
 * Combined cataloginventory_setup 1.6.0.0.1 & 1.6.0.0.1-1.6.0.0.2.
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 */

$installer = $this;
/* @var $installer Mage_Eav_Model_Entity_Setup */

$installer->startSetup();


// not used < 0.0.1
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/stock'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/stock'));
}
// not used < 0.0.1
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/stock_item'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/stock_item'));
}
// not used < 0.0.1
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/stock_status'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/stock_status'));
}
// not used < 0.0.1
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'));
}
// not used < 0.0.1
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'));
}


/**
 * Create table 'cataloginventory_stock'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/stock'))
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Stock Id')
    ->addColumn('stock_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Stock Name')
    ->setComment('Cataloginventory Stock');
$installer->getConnection()->createTable($table);

/**
 * Create table 'croghan_cataloginventory/stock_item'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/stock_item'))
    ->addColumn('item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Item Id')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Product Id')
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Stock Id')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Qty')
    ->addColumn('min_qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Min Qty')
    ->addColumn('use_config_min_qty', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Min Qty')
    ->addColumn('is_qty_decimal', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Is Qty Decimal')
    ->addColumn('backorders', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Backorders')
    ->addColumn('use_config_backorders', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Backorders')
    ->addColumn('min_sale_qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '1.0000',
        ), 'Min Sale Qty')
    ->addColumn('use_config_min_sale_qty', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Min Sale Qty')
    ->addColumn('max_sale_qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Max Sale Qty')
    ->addColumn('use_config_max_sale_qty', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Max Sale Qty')
    ->addColumn('is_in_stock', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Is In Stock')
    ->addColumn('low_stock_date', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Low Stock Date')
    ->addColumn('notify_stock_qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        ), 'Notify Stock Qty')
    ->addColumn('use_config_notify_stock_qty', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Notify Stock Qty')
    ->addColumn('manage_stock', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Manage Stock')
    ->addColumn('use_config_manage_stock', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Manage Stock')
    ->addColumn('stock_status_changed_auto', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Stock Status Changed Automatically')
    ->addColumn('use_config_qty_increments', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Qty Increments')
    ->addColumn('qty_increments', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Qty Increments')
    ->addColumn('use_config_enable_qty_inc', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        ), 'Use Config Enable Qty Increments')
    ->addColumn('enable_qty_increments', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Enable Qty Increments')
    // 1.6.0.0.1-1.6.0.0.2 upgrade //
    ->addColumn('is_decimal_divided', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => 0,
        ), 'Is Divided into Multiple Boxes for Shipping')
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_item', array('product_id', 'stock_id'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
        array('product_id', 'stock_id'), array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_item', array('product_id')),
        array('product_id')
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_item', array('stock_id')),
        array('stock_id')
    )
    ->addForeignKey($installer->getFkName('croghan_cataloginventory/stock_item', 'product_id', 'catalog/product', 'entity_id'),
        'product_id', $installer->getTable('catalog/product'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $installer->getFkName(
            'croghan_cataloginventory/stock_item', 'stock_id', 'croghan_cataloginventory/stock', 'stock_id'
        ),
        'stock_id', $installer->getTable('croghan_cataloginventory/stock'), 'stock_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Cataloginventory Stock Item');
$installer->getConnection()->createTable($table);

/**
 * Create table 'croghan_cataloginventory/stock_status'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/stock_status'))
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Product Id')
    ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Website Id')
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Stock Id')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Qty')
    ->addColumn('stock_status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Stock Status')
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_status', array('stock_id')),
        array('stock_id')
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_status', array('website_id')),
        array('website_id')
    )
    ->addForeignKey(
        $installer->getFkName(
            'croghan_cataloginventory/stock_status', 'stock_id', 'croghan_cataloginventory/stock', 'stock_id'
        ),
        'stock_id', $installer->getTable('croghan_cataloginventory/stock'), 'stock_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $installer->getFkName(
            'croghan_cataloginventory/stock_status', 'product_id', 'catalog/product', 'entity_id'
        ),
        'product_id', $installer->getTable('catalog/product'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey($installer->getFkName('croghan_cataloginventory/stock_status', 'website_id', 'core/website', 'website_id'),
        'website_id', $installer->getTable('core/website'), 'website_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Cataloginventory Stock Status');
$installer->getConnection()->createTable($table);

/**
 * Create table 'croghan_cataloginventory/stock_status_indexer_idx'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'))
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Product Id')
    ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Website Id')
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Stock Id')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Qty')
    ->addColumn('stock_status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Stock Status')
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_status_indexer_idx', array('stock_id')),
        array('stock_id')
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_status_indexer_idx', array('website_id')),
        array('website_id')
    )
    ->setComment('Cataloginventory Stock Status Indexer Idx');
$installer->getConnection()->createTable($table);

/**
 * Create table 'croghan_cataloginventory/stock_status_indexer_tmp'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'))
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Product Id')
    ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Website Id')
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Stock Id')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Qty')
    ->addColumn('stock_status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Stock Status')
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_status_indexer_tmp', array('stock_id')),
        array('stock_id')
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/stock_status_indexer_tmp', array('website_id')),
        array('website_id')
    )
    ->setComment('Cataloginventory Stock Status Indexer Tmp');
$installer->getConnection()->createTable($table);

$installer->endSetup();

$installer->getConnection()->insertForce($installer->getTable('croghan_cataloginventory/stock'), array(
    'stock_id'      => 1,
    'stock_name'    => 'Default'
));
