<?php
/**
 * Installer
 *
 * Adding multi-warehouse columns.
 *
 * @category    Croghan
 * @package     Croghan_CatalogInventory
 */

$installer = $this;
/* @var $installer Mage_Eav_Model_Entity_Setup */

$installer->startSetup();

/*
Current schema before changes; 

mysql> show columns from cataloginventory_stock;
+------------+----------------------+------+-----+---------+----------------+
| Field      | Type                 | Null | Key | Default | Extra          |
+------------+----------------------+------+-----+---------+----------------+
| stock_id   | smallint(5) unsigned | NO   | PRI | NULL    | auto_increment |
| stock_name | varchar(255)         | YES  |     | NULL    |                |
+------------+----------------------+------+-----+---------+----------------+
2 rows in set (0.37 sec)

mysql> show columns from cataloginventory_stock_item;
+-----------------------------+----------------------+------+-----+---------+----------------+
| Field                       | Type                 | Null | Key | Default | Extra          |
+-----------------------------+----------------------+------+-----+---------+----------------+
| item_id                     | int(10) unsigned     | NO   | PRI | NULL    | auto_increment |
| product_id                  | int(10) unsigned     | NO   | MUL | 0       |                |
| stock_id                    | smallint(5) unsigned | NO   | MUL | 0       |                |
| qty                         | decimal(12,4)        | NO   |     | 0.0000  |                |
| min_qty                     | decimal(12,4)        | NO   |     | 0.0000  |                |
| use_config_min_qty          | smallint(5) unsigned | NO   |     | 1       |                |
| is_qty_decimal              | smallint(5) unsigned | NO   |     | 0       |                |
| backorders                  | smallint(5) unsigned | NO   |     | 0       |                |
| use_config_backorders       | smallint(5) unsigned | NO   |     | 1       |                |
| min_sale_qty                | decimal(12,4)        | NO   |     | 1.0000  |                |
| use_config_min_sale_qty     | smallint(5) unsigned | NO   |     | 1       |                |
| max_sale_qty                | decimal(12,4)        | NO   |     | 0.0000  |                |
| use_config_max_sale_qty     | smallint(5) unsigned | NO   |     | 1       |                |
| is_in_stock                 | smallint(5) unsigned | NO   |     | 0       |                |
| low_stock_date              | timestamp            | YES  |     | NULL    |                |
| notify_stock_qty            | decimal(12,4)        | YES  |     | NULL    |                |
| use_config_notify_stock_qty | smallint(5) unsigned | NO   |     | 1       |                |
| manage_stock                | smallint(5) unsigned | NO   |     | 0       |                |
| use_config_manage_stock     | smallint(5) unsigned | NO   |     | 1       |                |
| stock_status_changed_auto   | smallint(5) unsigned | NO   |     | 0       |                |
| use_config_qty_increments   | smallint(5) unsigned | NO   |     | 1       |                |
| qty_increments              | decimal(12,4)        | NO   |     | 0.0000  |                |
| use_config_enable_qty_inc   | smallint(5) unsigned | NO   |     | 1       |                |
| enable_qty_increments       | smallint(5) unsigned | NO   |     | 0       |                |
| is_decimal_divided          | smallint(5) unsigned | NO   |     | 0       |                |
+-----------------------------+----------------------+------+-----+---------+----------------+
25 rows in set (0.00 sec)

mysql> show columns from cataloginventory_stock_status;
+--------------+----------------------+------+-----+---------+-------+
| Field        | Type                 | Null | Key | Default | Extra |
+--------------+----------------------+------+-----+---------+-------+
| product_id   | int(10) unsigned     | NO   | PRI | NULL    |       |
| website_id   | smallint(5) unsigned | NO   | PRI | NULL    |       |
| stock_id     | smallint(5) unsigned | NO   | PRI | NULL    |       |
| qty          | decimal(12,4)        | NO   |     | 0.0000  |       |
| stock_status | smallint(5) unsigned | NO   |     | NULL    |       |
+--------------+----------------------+------+-----+---------+-------+
5 rows in set (0.00 sec)

mysql> show columns from cataloginventory_stock_status_idx;
+--------------+----------------------+------+-----+---------+-------+
| Field        | Type                 | Null | Key | Default | Extra |
+--------------+----------------------+------+-----+---------+-------+
| product_id   | int(10) unsigned     | NO   | PRI | NULL    |       |
| website_id   | smallint(5) unsigned | NO   | PRI | NULL    |       |
| stock_id     | smallint(5) unsigned | NO   | PRI | NULL    |       |
| qty          | decimal(12,4)        | NO   |     | 0.0000  |       |
| stock_status | smallint(5) unsigned | NO   |     | NULL    |       |
+--------------+----------------------+------+-----+---------+-------+
5 rows in set (0.00 sec)

mysql> show columns from cataloginventory_stock_status_tmp;
+--------------+----------------------+------+-----+---------+-------+
| Field        | Type                 | Null | Key | Default | Extra |
+--------------+----------------------+------+-----+---------+-------+
| product_id   | int(10) unsigned     | NO   | PRI | NULL    |       |
| website_id   | smallint(5) unsigned | NO   | PRI | NULL    |       |
| stock_id     | smallint(5) unsigned | NO   | PRI | NULL    |       |
| qty          | decimal(12,4)        | NO   |     | 0.0000  |       |
| stock_status | smallint(5) unsigned | NO   |     | NULL    |       |
+--------------+----------------------+------+-----+---------+-------+
5 rows in set (0.00 sec)
*/


// not used < 0.0.2
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/warehouse'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/warehouse'));
}
// not used < 0.0.2
if($installer->getConnection()->isTableExists($installer->getTable('croghan_cataloginventory/warehouse_item'))){
    $installer->getConnection()->dropTable($installer->getTable('croghan_cataloginventory/warehouse_item'));
}


/**
 * Create table 'croghan_cataloginventory_warehouse'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/warehouse'))
    ->addColumn('warehouse_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Warehouse Id')
    ->addColumn('stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        ), 'Stock Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Warehouse Name')
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
        'nullable'  => false
        ), 'Warehouse Code')
    ->addColumn('postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => true
        ), 'Warehouse Code')
    ->addIndex($installer->getIdxName('croghan_cataloginventory/warehouse', array('stock_id')),
        array('stock_id')
    )
    ->addForeignKey(
        $installer->getFkName(
            'croghan_cataloginventory/warehouse', 'warehouse_id', 'croghan_cataloginventory/stock', 'stock_id'
        ),
        'stock_id', $installer->getTable('croghan_cataloginventory/stock'), 'stock_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('CatalogInventory Warehouse');
$installer->getConnection()->createTable($table);


/**
 * Create table 'croghan_cataloginventory_warehouse_item'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('croghan_cataloginventory/warehouse_item'))
    ->addColumn('warehouse_item_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Warehouse Item Id')
    ->addColumn('warehouse_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Warehouse Id')
    ->addColumn('stock_item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Stock Item Id')
    ->addColumn('qty_available', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
        ), 'Available Qty')
    ->addIndex($installer->getIdxName('croghan_cataloginventory/warehouse_item', array('warehouse_id')),
        array('warehouse_id')
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/warehouse_item', array('stock_item_id')),
        array('stock_item_id')
    )
    ->addIndex($installer->getIdxName('croghan_cataloginventory/warehouse_item', array('stock_item_id', 'warehouse_id'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
        array('stock_item_id', 'warehouse_id'), array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
    )
    ->addForeignKey(
        $installer->getFkName(
            'croghan_cataloginventory/warehouse_item', 'warehouse_item_id', 'croghan_cataloginventory/stock_item', 'item_id'
        ),
        'warehouse_item_id', $installer->getTable('croghan_cataloginventory/stock_item'), 'item_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('CatalogInventory Warehouse Item');
$installer->getConnection()->createTable($table);


/**
 * Modify table 'croghan_cataloginventory/stock_status'
 */
$installer->getConnection()->dropColumn($installer->getTable('croghan_cataloginventory/stock_status'), 'store_id');
$installer->getConnection()->addColumn(
    $installer->getTable('croghan_cataloginventory/stock_status'),
    'store_id',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned' => true,
        'default' => 0,
        'nullable' => false,
        'after' => 'website_id',
        'comment' => 'Store Id')
);
// update primary key
$installer->getConnection()->addIndex($installer->getTable('croghan_cataloginventory/stock_status'),
    'primary', 
    array('product_id', 'website_id', 'store_id', 'stock_id'), 
    Varien_Db_Adapter_Interface::INDEX_TYPE_PRIMARY
);
// old primary key; may not be needed
$installer->getConnection()->addIndex($installer->getTable('croghan_cataloginventory/stock_status'),
    $installer->getIdxName('croghan_cataloginventory/stock_status', array('product_id', 'website_id', 'stock_id')),
    array('product_id', 'website_id', 'stock_id'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
);
// add store_id fk
$installer->getConnection()->dropForeignKey(
    $installer->getTable('croghan_cataloginventory/stock_status'),
    $installer->getFkName('croghan_cataloginventory/stock_status', 'store_id', 'core/store', 'store_id')
);
$installer->getConnection()->addForeignKey(
    $installer->getFkName('croghan_cataloginventory/stock_status', 'store_id', 'core/store', 'store_id'),
    $installer->getTable('croghan_cataloginventory/stock_status'),
    'store_id',
    'store_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

/**
 * Modify table 'croghan_cataloginventory/stock_status_indexer_idx'
 */
$installer->getConnection()->dropColumn($installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'), 'store_id');
$installer->getConnection()->addColumn(
    $installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'),
    'store_id',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned' => true,
        'default' => 0,
        'nullable' => false,
        'after' => 'website_id',
        'comment' => 'Store Id')
);
// update primary key
$installer->getConnection()->addIndex($installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'),
    'primary', 
    array('product_id', 'website_id', 'store_id', 'stock_id'), 
    Varien_Db_Adapter_Interface::INDEX_TYPE_PRIMARY
);
// old primary key; may not be needed
$installer->getConnection()->addIndex($installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'),
    $installer->getIdxName('croghan_cataloginventory/stock_status_indexer_idx', array('product_id', 'website_id', 'stock_id')),
    array('product_id', 'website_id', 'stock_id'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
);
// add store_id fk
$installer->getConnection()->dropForeignKey(
    $installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'),
    $installer->getFkName('croghan_cataloginventory/stock_status_indexer_idx', 'store_id', 'core/store', 'store_id')
);
$installer->getConnection()->addForeignKey(
    $installer->getFkName('croghan_cataloginventory/stock_status_indexer_idx', 'store_id', 'core/store', 'store_id'),
    $installer->getTable('croghan_cataloginventory/stock_status_indexer_idx'),
    'store_id',
    'store_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

/**
 * Modify table 'croghan_cataloginventory/stock_status_indexer_tmp'
 */
$installer->getConnection()->dropColumn($installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'), 'store_id');
$installer->getConnection()->addColumn(
    $installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'),
    'store_id',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned' => true,
        'default' => 0,
        'nullable' => false,
        'after' => 'website_id',
        'comment' => 'Store Id')
);
// update primary key
$installer->getConnection()->addIndex($installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'),
    'primary', 
    array('product_id', 'website_id', 'store_id', 'stock_id'), 
    Varien_Db_Adapter_Interface::INDEX_TYPE_PRIMARY
);
// old primary key; may not be needed
$installer->getConnection()->addIndex($installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'),
    $installer->getIdxName('croghan_cataloginventory/stock_status_indexer_tmp', array('product_id', 'website_id', 'stock_id')),
    array('product_id', 'website_id', 'stock_id'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX
);
// add store_id fk
$installer->getConnection()->dropForeignKey(
    $installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'),
    $installer->getFkName('croghan_cataloginventory/stock_status_indexer_tmp', 'store_id', 'core/store', 'store_id')
);
$installer->getConnection()->addForeignKey(
    $installer->getFkName('croghan_cataloginventory/stock_status_indexer_tmp', 'store_id', 'core/store', 'store_id'),
    $installer->getTable('croghan_cataloginventory/stock_status_indexer_tmp'),
    'store_id',
    'store_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$installer->endSetup();