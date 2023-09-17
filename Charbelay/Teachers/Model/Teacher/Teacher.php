<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\Teachers\Model\Teacher;

use Magento\Framework\Model\AbstractModel;
use Charbelay\Teachers\Model\Teacher\ResourceModel\Teacher as TeacherResourceModel;

class Teacher extends AbstractModel
{
    protected function _construct(): void
    {
        $this->_init(TeacherResourceModel::class);
    }
}
