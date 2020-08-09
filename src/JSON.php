<?php

require_once __DIR__ . '/SerializeInterface.php';
class JSON implements SerializeInterface {
    public function serialize($object) {
        $reflection = new ReflectionClass($object);
        $public_value = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $public_value[$property->getName()] = $property->getValue($object);
        }

        return json_encode($public_value);
    }
}