# Library for serializing
This library can serialize your php objects into `JSON`, `YAML` and `XML`.
# Table of contents
1. [How to use](#How-to-use)
2. [Library extension](#Library-extension)
3. [Example](#Example)
## How to use
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
## Library extension
If you would add new formats, you should create new class in `src` folder. 
This class must realize `SerializeInterface.php` and return string.
```php
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
    private $value2 = "Value2";
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
$serialized_obj = $yaml->serialize($test);

#Views results
echo "<pre>";
echo $serialized_obj;
echo "</pre>";
```