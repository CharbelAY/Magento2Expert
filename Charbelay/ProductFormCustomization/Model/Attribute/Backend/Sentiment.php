<?php


namespace Charbelay\ProductFormCustomization\Model\Attribute\Backend;


use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Sentiment extends AbstractBackend
{
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (($object->getAttributeSetId() === '10') && $value === 'sad') {
            throw new LocalizedException(__('Bottoms Cannot have the sad sentiment'));
        }
    }
}
