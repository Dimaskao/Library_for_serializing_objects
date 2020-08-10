# Library for serializing
This library can serialize your php objects into `JSON`, `YAML` and `XML`.
# Table of contents
* [How to use](#How-to-use)
    * [General](#General)
    * [Field selection](#Field-selection)
* [Library extension](#Library-extension)
* [Example](#Example)
## How to use
###General
At first include this library: `require_once __DIR__ . 'XXXXX/src/SerializeLibrary.php'`.
Where `XXXXX` path to library root folder.

If you want to serialize an object, you should create a new `JSON`, `YAML` or `XML` object.
```php
$json = new JSON;
$yaml = new YAML;
$xml = new XML;
```

Then use `->serialize()` method and pass an object to it.
This method will return string with serialized object. 
```php
$json = new JSON;
$json->serialize($obj);
```
###Field selection
If you do not want to serialize the all object, you can select individual fields. 
For this pass array in `serialize()` with name of field.
```php
$json = new JSON;
$json->serialize($obj, ["value1", "value3"]);
```
## Library extension
If you would add new formats, you should create new class in `src` folder. 
This class must realize `SerializeInterface.php` and return string.
```php
require_once __DIR__ . '/SerializeInterface.php';

class Your_Format implements SerializeInterface {
    public function serialize($object) {

        return $serialized_obj;
    }
}
```
Also you should add path to your class into `SerializeLibrary.php`.

`require_once __DIR__ . '/Your_Class.php';`

## Example
Let's see how it works using the YAML example.
```php
#Include library
require_once __DIR__ . '/src/SerializeLibrary.php';

#Creating test class
class Test {

    public $value = "Value";
    public $value1 = "Value1";
    private $value2 = ["Value2.1" => "first", "Value2.2" => 2];
    protected $value3;

    function __construct($item) {
        $this->value3 = $item;
    }
}
#Creating test object
$test = new Test("Value3");

#Creating YAML object
$yaml = new YAML;

#Saving serialized object
$serialized_obj = $yaml->serialize($test, ["value", "value2"]);

#Views results
echo "<pre>";
print_r($serialized_obj);
echo "</pre>";
```
As a result, we get.
```yaml
---
value: Value
value2:
  Value2.1: first
  Value2.2: 2
...
```