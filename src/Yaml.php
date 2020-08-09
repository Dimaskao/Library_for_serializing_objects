<?php

require_once __DIR__ . '/SerializeInterface.php';
class Yaml implements SerializeInterface {
    public function serialize($object) {
        $reflection = new ReflectionClass($object);
        $public_value = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $public_value[$property->getName()] = $property->getValue($object);
        }

        return yaml_emit($public_value);
    }
}