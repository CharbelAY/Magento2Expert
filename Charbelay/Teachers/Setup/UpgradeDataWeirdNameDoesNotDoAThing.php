<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\Teachers\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeDataWeirdNameDoesNotDoAThing implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context): void
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.3', '<')) {
            $this->updateTeacherSurnames($setup);
        }

        $setup->endSetup();
    }

    private function updateTeacherSurnames(ModuleDataSetupInterface $setup): void
    {
        $connection = $setup->getConnection();
        $tableName = $setup->getTable('teachers');

        // Update Einstein's surname
        $connection->update(
            $tableName,
            ['surname' => 'ok'],
            ['name = ?' => 'Einstein']
        );

        // Update Bogdan's surname
        $connection->update(
            $tableName,
            ['surname' => 'test'],
            ['name = ?' => 'Boris']
        );
    }
}
