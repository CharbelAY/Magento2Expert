<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\Teachers\Model\Teacher\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Teacher extends AbstractDb
{
    private const DB_NAME = 'teachers';
    private const PRIMARY_KEY = 'id';

    protected function _construct(): void
    {
        $this->_init(self::DB_NAME, self::PRIMARY_KEY);
    }
}
