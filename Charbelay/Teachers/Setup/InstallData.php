<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\Teachers\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            ['name' => 'Einstein'],
            ['name' => 'Boris'],
        ];

        foreach ($data as $teacher) {
            $setup->getConnection()->insertForce($setup->getTable('teachers'), $teacher);
        }
    }
}
