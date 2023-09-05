<b>Topics:</b><br>
- Commerce for developers - Declarative schema
  - https://devdocs.magento.com/guides/v2.3/extension-dev-guide/declarative-schema/migration-commands.html
- Add a new table to a database (outdated but might be asked about in the exam)
  - https://experienceleague.adobe.com/docs/commerce-learn/tutorials/backend-development/new-db-table.html?lang=en
- Declarative Schema
  - https://developer.adobe.com/commerce/php/development/components/declarative-schema/
- Data Transfer
- Custom import entity
- Importing and Exporting Inventory
- Develop data and schema patches
  - https://developer.adobe.com/commerce/php/development/components/declarative-schema/patches/
- Add an Admin grid
- Listing (grid) component
- Form component
- ActionsColumn component
- PHP modifiers
- Customize using a modifier class
- Create an access control list (ACL) rule

<b>This module has install/upgrade scripts they create a dummy table. I just added them for the sake of showing how previously this was done</b>
# Commerce for developers - Declarative schema & Declarative Schema <br>
This was created to avoid the problems previous install/upgrade scripts had.<br>
One of them was having to track down module versioning and having to understand what previous scripts did.<br>
Now with this new approach you just describe the final state of the db that you desire and the magento system will do the needed changes<br>
<b>When using declarative schema, uninstalling the module will remove the tables and the data stored in them</b><br>
<br>
To switch old modules that used schema patches to declarative schema we need to do the following:
- Develop a schema/data patch (To populate the tables you will create in the declarative schema)
- Configure the declarative schema files
- Convert install/upgrade scripts to declarative schema
<br>
Once you switched to declarative schema you cannot go back to upgrade scripts<br>
<br>
<br>
To convert old install/upgrade schema scripts you can run<br>
```bin/magento setup:install --convert-old-scripts=1``` or ```bin/magento setup:upgrade --convert-old-scripts=1```<br>
The conversion tool will only convert operations represented in ```\Magento\Framework\DB\Adapter\Pdo\Mysql```<br>
To convert  install/upgrade data scripts to the data patch format:<br>
Use ```bin/magento setup:db-declaration:generate-patch [options] <module-name> <patch-name>```<br>
Where options can be ```--revertable[=true | false]``` and ```--type[=<type>]``` by default type is data (data patch)<br>
<br>
To test without changing anything in the db add ```--dry-run=1``` to setup upgrade/install<br>
All operations will be logged in ```<Magento_Root>/var/log/dry-run-installation.log```.<br>
Also use ```--safe-mode=1``` it will create a dump during set:upg and set:install<br>
It will aslo create csv files containing all the data that was removed with destructive operations in ```Magento_root/var/declarative_dumps_csv/```
Use ```--data-restore``` to restore the data only when using set:upg<br>
<br>
<br>

Creating a schema whitelist<br>
Whitelist does not work on magento systems that use db prefixes<br>
Run ```bin/magento setup:db-declaration:generate-whitelist [options]```, where options can be --module-name to specify the module name, if not used all modules will get the whitelist generated<br>

Schema/Data Patch terminology:<br>
- Data patch --> class modifying system data that can depend on other patches(schema or data)
- Revertible data patches --> has a revert function to revert changes 
- Migration --> Non revertible data patch
- Schema patch --> Schema patches are used when declarative schema is not possible. Example when we need to add triggers or partition a db
- Revertible schema patches --> changes can be reverted in revert function

# Develop data and schema patches<br>
https://developer.adobe.com/commerce/php/development/components/declarative-schema/patches/ <br>
Only note to add is that ```$this->moduleDataSetup->getConnection()->startSetup();```
will do the following <br>
```php
$this->rawQuery("SET SQL_MODE=''");
$this->rawQuery("SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0");
$this->rawQuery("SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO'");
```
And  ```$this->moduleDataSetup->getConnection()->endSetup();``` will revert these changes

# Add a new table to a database (outdated but might be asked about in the exam)
Old way of doing things.<br>
In module.xml add setup_version
Add under Setup folder 4 files.<br>
InstallData, InstallSchema, UpgradeData, UpgradeSchema.<br>
They implement interfaces that have their name + interface --> ```InstallData implements InstallDataInterface```
Install only run one time when the module is installed<br>
Upgrade run every time but inside of them add a version check to choose if the data/schema has changed or not<br>
Their names is important check UpgradeDataWeirdNameDoesNotDoAThing it won't run<br>
Data about them is stored in ```setup_module``` with module name schema_version and data_version.<br>
You guest it magento keeps track of data and schema stuff seperately it's good in case one fails then it won't update the entry in the db and you will be able to fix the script and rerun it<br>

