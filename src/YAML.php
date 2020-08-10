<?php

require_once __DIR__ . '/SerializeInterface.php';
class YAML implements SerializeInterface {
    public function serialize($object, $elemetn_list = false) {
        $reflection = new ReflectionClass($object);
        $public_value = [];

        #Using reflection to get privat and protection elements
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $public_value[$property->getName()] = $property->getValue($object);
        }

        #Saving only the specified fields
        if($elemetn_list) {
            $result = [];
            foreach ($elemetn_list as $value) {
                if (array_key_exists($value, $public_value)) {
                    $result[$value] = $public_value[$value];
                }
            }
            $public_value = $result;
        }

        #Returning result
        return yaml_emit($public_value);
    }
}