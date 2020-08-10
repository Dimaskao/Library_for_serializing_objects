#!/usr/bin/php

<?php

#Include library
require_once __DIR__ . '/../src/SerializeLibrary.php';

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
$json = new JSON;

#Saving serialized object
$serialized_obj = $json->serialize($test, ["value", "value2"]);

#Views results
echo "<pre>";
print_r($serialized_obj);
echo "</pre>";