<?php

require_once __DIR__ . '/SerializerInterface.php';
class YAML implements SerializeInterface {
    final public function serialize($object, $elemetn_list = []) {

        $reflection = new ReflectionClass($object);
        $public_value = [];

        //Using reflection to get privat and protection elements
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $public_value[$property->getName()] = $property->getValue($object);
        }

        //Saving only the specified fields
        if($elemetn_list) {
            $result = [];
            foreach ($elemetn_list as $value) {
                if (isset($public_value[$value])) {
                    $result[$value] = $public_value[$value];
                }
            }
            $public_value = $result;
        }

        //Returning result
        return yaml_emit($public_value);
    }
}