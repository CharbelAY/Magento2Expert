<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\Teachers\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context): void
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('teachers'),
                'surname',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'Surname'
                ]
            );
        }

        $setup->endSetup();
    }
}
