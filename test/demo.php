#!/usr/bin/php

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dimaskao\Serializer\_YAML_;

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
$yaml = new _YAML_();

//Saving serialized object
$serialized_obj = $yaml->serialize($test, ["value", "value2"]);

//Views results
print_r($serialized_obj);