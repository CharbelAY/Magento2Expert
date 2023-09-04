<?php


namespace Charbelay\ProductFormCustomization\Setup\Patch\Data;


use Charbelay\ProductFormCustomization\Model\Attribute\Source\Sentiment;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Eav\Setup\EavSetupFactory;


class ReaddSentimentAttribute implements DataPatchInterface
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
        return [
            RemoveProductSentimentAttribute::class
        ];
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
                'apply_to' => implode(',', [Type::TYPE_SIMPLE, Type::TYPE_BUNDLE]),
                'attribute_model' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::class,
                'attribute_set' => 'Default',
                'backend' => \Charbelay\ProductFormCustomization\Model\Attribute\Backend\Sentiment::class,
                'comparable' => true,
                'default' => 'happy',
                'filterable_in_search' => true,
                'frontend_class' => \Charbelay\ProductFormCustomization\Model\Attribute\Frontend\Sentiment::class,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'general',
                'is_filterable_in_grid' => true,
                'is_html_allowed_on_front' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'note' => 'Sentiment evoked by the product',
                'position' => 1,
                'required' => true,
                'searchable' => true,
                'sort_order' => 1,
                'source' => Sentiment::class,
                'system' => 0,
                'type' => 'varchar',
                'unique' => 0,
                'used_for_promo_rules' => true,
                'used_for_sort_by' => false,
                'used_in_product_listing' => true,
                'user_defined' => 1,
                'visible_in_advanced_search' => true,
                'visible_on_front' => true,
                'visible' => true,
                'wysiwyg_enabled' => false,
                'label' => 'Sentiment',
                'input' => 'select',
                'filterable' => true,
            ]);
        } catch (LocalizedException|\Zend_Validate_Exception $e) {
            return;
        }
    }
}
