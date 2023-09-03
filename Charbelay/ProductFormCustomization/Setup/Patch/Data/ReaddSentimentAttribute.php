<?php


namespace Charbelay\ProductFormCustomization\Setup\Patch\Data;


use Charbelay\ProductFormCustomization\Model\Attribute\Source\Sentiment;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class ReaddSentimentAttribute implements DataPatchInterface
{

    public static function getDependencies()
    {
        return [
            RemoveProductSentimentAttribute::class
        ];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        try {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
            $eavSetup->addAttribute(Product::ENTITY, 'sentiment', [
            ]);
        } catch (LocalizedException|\Zend_Validate_Exception $e) {
            return;
        }
    }
}
