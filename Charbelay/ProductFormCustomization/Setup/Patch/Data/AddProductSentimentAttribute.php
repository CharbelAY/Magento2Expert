<?php


namespace Charbelay\ProductFormCustomization\Setup\Patch\Data;


use Charbelay\ProductFormCustomization\Model\Attribute\Source\Sentiment;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Setup\EavSetup;

class AddProductSentimentAttribute implements DataPatchInterface
{

    private ModuleDataSetupInterface $moduleDataSetup;
    private EavSetupFactory $eavSetupFactory;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup, EavSetupFactory $eavSetupFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {
        try {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
            $eavSetup->addAttribute(Product::ENTITY, 'sentiment', [
                'group' => 'general',
                'type' => 'varchar',
                'label' => 'Sentiment',
                'input' => 'select',
                'source' => Sentiment::class,
                'frontend' => \Charbelay\ProductFormCustomization\Model\Attribute\Frontend\Sentiment::class,
                'backend' => \Charbelay\ProductFormCustomization\Model\Attribute\Backend\Sentiment::class,
                'required' => false,
                'sort_order' => 100,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true,
            ]);
        } catch (LocalizedException|\Zend_Validate_Exception $e) {
            return;
        }
    }
}
