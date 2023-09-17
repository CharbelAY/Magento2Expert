# Console Commands

- Command name can be set in 3 ways:
  - ```$this-.setName('my:first:command')``` in the command class configure method
  - Pass it as an argument to the command class in di.xml 
  - Pass it in the constructor when calling the parent constructor ```parent::__construct('my:first:command')```
- Command classes can use Object manager as well as dependency injection
- Command system uses Symphony 
- In the ```configure``` function we cna do many things like:
  - setName
  - setDescription
  - addOption(name,shortcut,InputOption::SOME_VALIDATION_CONSTANT,description,default_value)
- Cli commands don't have the area set so you need to set it if it's needed using State class

try ```XDEBUG_CONFIG=idekey=phpstorm bin/magento show:Cli:default:area --shouldSayHello true```
