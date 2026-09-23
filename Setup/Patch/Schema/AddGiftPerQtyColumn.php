<?php

namespace C4B\FreeProduct\Setup\Patch\Schema;

use C4B\FreeProduct\SalesRule\Action\AbstractGiftAction;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;

/**
 * Add a field for "gift per X qty" into SalesRule entity.
 *
 * @package    C4B_FreeProduct
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class AddGiftPerQtyColumn implements SchemaPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $connection = $this->moduleDataSetup->getConnection();
        $table = $this->moduleDataSetup->getTable('salesrule');

        if (!$connection->tableColumnExists($table, AbstractGiftAction::RULE_DATA_KEY_PER_QTY)) {
            $connection->addColumn($table, AbstractGiftAction::RULE_DATA_KEY_PER_QTY, [
                'type' => Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable' => true,
                'comment' => 'Qty of product required per gift'
            ]);
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
