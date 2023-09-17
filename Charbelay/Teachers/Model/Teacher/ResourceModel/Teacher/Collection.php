<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\Teachers\Model\Teacher\ResourceModel\Teacher;

use Charbelay\Teachers\Model\Teacher\Teacher;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Teacher::class, \Charbelay\Teachers\Model\Teacher\ResourceModel\Teacher::class);
    }
}
