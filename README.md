# Library for serializing
This library can serialize your php objects into `JSON`, `YAML` and `XML`.
# Table of contents
* [How to use](#How-to-use)
    * [General](#General)
    * [Field selection](#Field-selection)
* [Library extension](#Library-extension)
* [Example](#Example)
## How to use
### General
At first include this library classes: 
```php
require_once __DIR__ . '/XXXXX/vendor/autoload.php';

use Dimaskao\Serializer\JSON   //|\
use Dimaskao\Serializer\XML    //|- Choose what you need
use Dimaskao\Serializer\YAML //|/
```
Where `XXXXX` path to library root folder. 

If you want to serialize an object, you should create a new `JSON`, `_YAML_` or `XML` object.
```php
$json = new JSON();
$yaml = new YAML();
$xml = new XML();
```

Then use `->serialize()` method and pass an object to it.
This method will return string with serialized object. 
```php
$json = new JSON();
$json->serialize($obj);
```
### Field selection
If you do not want to serialize the all object, you can select individual fields. 
For this pass array in `serialize()` with name of field.
```php
$json = new JSON();
$json->serialize($obj, ["value1", "value3"]);
```
## Library extension
If you would add new formats, you should create your own class 
which extends `AbstractSerializer.php` and implements `SerializerInterface.php`.
```php
require_once __DIR__ . '/vendor/autoload.php';
use Dimaskao\Serializer\AbstractSerializer;
use Dimaskao\Serializer\SerializerInterface;

class YourFormat extends AbstractSerializer implements SerializerInterface {

}
```
This class must have a `serialize()` method. Use `$this->get_data()` to get all fields in an object.

`$elemetn_list` - optional array with the fields to get. Watch [Field selection](#Field-selection).
```php
class YourFormat extends AbstractSerializer implements SerializerInterface {
    public function serialize($obj, $elemetn_list = []){
        $public_value = $this->get_data($obj, $elemetn_list);
    }
}
```
Then you can do whatever you want with `$public_value`, for example:
```php 
return json_encode($public_value)
```

## Example
Let's see how it works using the YAML example.
```php
//Include library
require_once __DIR__ . '/vendor/autoload.php';

use Dimaskao\Serializer\YAML;

//Creating test class
class Test {

    public $value = "Value";
    public $value1 = "Value1";
    private $value2 = ["Value2.1" => "first", "Value2.2" => 2];
    protected $value3;

    function __construct($item) {
        $this->value3 = $item;
    }
}
//Creating test object
$test = new Test("Value3");

//Creating YAML object
$yaml = new YAML();

//Saving serialized object
$serialized_obj = $yaml->serialize($test, ["value", "value2"]);

//Views results
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