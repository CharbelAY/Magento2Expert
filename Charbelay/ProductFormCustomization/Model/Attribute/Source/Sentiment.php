<?php


namespace Charbelay\ProductFormCustomization\Model\Attribute\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Sentiment extends AbstractSource
{

    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Happy'), 'value' => 'happy'],
                ['label' => __('Sad'), 'value' => 'sad'],
                ['label' => __('Calm'), 'value' => 'calm'],
                ['label' => __('Focused'), 'value' => 'focused'],
            ];
        }
        return $this->_options;
    }
}
