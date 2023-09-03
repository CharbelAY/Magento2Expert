# Dynamic Configs Row 

<b>Topics covered: Section 3, Commerce for developers - Create an Admin Page</b>

1. Create ```etc/adminhtml/system.xml```<br>
Add a field that has a ```backend_model``` set to<br>
 ```Magento\Config\Model\Config\Backend\Serialized\ArraySerialized```<br>
And a ```frontend_model``` that extends<br>
 ```Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray```<br>

2. Create the ```frontend_model``` under ```Block/Adminhtml/Form/Field```<br>
override ```_prepareToRender``` and add the columns inside of it using<br>
```$this->addColumn('column_identifier', ['label' => __('Column display label'), 'class' => 'validation classes']);```<br>
To change the add button label use ``` $this->_addButtonLabel = __('Add');```<br>
Or to use a more advanced column use ```$this->addColumn('tax', ['label' => __('Tax'),'renderer' => $this->getRenderer()]);```<br>
Where getRenderer can extend classes in ```Magento\Framework\View\Element\Html```<br>
Those classes can be ```Select,Links,Link,Date,Calendar```<br>

<b>NB: You can add default values to the dynamic configs by adding them in ```etc/config.xml```</b><br>

<b>References: https://developer.adobe.com/commerce/php/tutorials/admin/create-dynamic-row-configuration/</b>

