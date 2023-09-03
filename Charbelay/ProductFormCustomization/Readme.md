# Add/Remove Product attribute

<b>Topics covered:</b><br>
Section 2,How to add a new product attribute<br>
Section 2, Develop data and schema patches<br>
Section 3, Commerce for developers - Create an Admin Page (Customise Product grid section)

1. Create a data patch<br>
The patch should extend<br> ```Magento\Framework\Setup\Patch\DataPatchInterface```<br>
And for EAV entities like product it should use <br>```Magento\Eav\Setup\EavSetupFactory```<br>
create an $eavsetup and call on it ```addAttribute(entity_type, attribute_name,attribute configs array)```<br><br>
<b>The attribute configs array can take many options like:</b> 
- apply_to --> define which product types the attribute applies to
- attribute_model --> 
- attribute_set --> name of attribute set it belongs to, works in combination to group
- backend --> Backend class that controls validation, aftersave and aftersave, afterdelete
- comparable --> define if this attribute can be used in the product compare functionality
- defaul --> Default value
- filterable_in_search
- filterable
- frontend_class
- frontend
- global --> Define the scope of the attribute
- group --> attribute group name
- is_filterable_in_grid --> SE
- is_html_allowed_on_front --> allow attribute to be rendered as html
- is_used_in_grid -> SE
- is_visible_in_grid --> SE
- note --> Will show under the attribute as extra explanations
- position --> position in the layered navigation
- required --> self-explanatory
- searchable --> allow clients to search for values of that attribute
- sort_order --> sort order between other attributes in an attribute set
- source --> Source model that will allow admin to select between options
- type --> the backend type I think it can be the following but not sure ('boolean', 'date', 'datetime', 'multiselect', 'price', 'select', 'text', 'textare, 'weight')
- system --> declare the attribute as a system attribute (opposite of user_defined) not editable on backend
- table --> backend table
- unique --> It's unique accross other instances of the eav entity, example can be sku
- used_for_promo_rules --> to define if this property can be used in catalog/product cart price rules
- used_for_sort_by --> for sorting on the product listing(catalog) page
- used_in_product_listing --> if the attribute is available on the returned products on a catalog page.
- user_defined --> declares if the attribute is a system attribute or not. System ones(nt user defined) cannot be deleted from admin. such as sku, price...
- visible_in_advanced_search --> In magento there is a feature of advanced search on the storefront. Allows to add or not to this form
- visible_on_front --> If visible on frontend
- visible --> If possible to edit it in admin or not
- wysiwyg_enabled --> enable wysiwyg for textarea types

2. Remove a created EAV attribute<br>
```$eavSetup->removeAttribute($entityTypeId, 'sorting_attribute')```
