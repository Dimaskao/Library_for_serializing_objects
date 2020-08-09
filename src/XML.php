<?php

require_once __DIR__ . '/SerializeInterface.php';
class XML implements SerializeInterface {
    final public function serialize($object){

        $reflection = new ReflectionClass($object);
        $public_value = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $public_value[$property->getName()] = $property->getValue($object);
        }

        $xml_value = new SimpleXMLElement('<elements/>');

        $xml_result =  $this->deep_serialize($public_value, $xml_value);

        return $xml_result->asXML();
    }

    final private function deep_serialize($public_value, $xml_value){
        foreach( $public_value as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key;
                }
                $subnode = $xml_value->addChild($key);
                $this->deep_serialize($value, $subnode);
            } else {
                $xml_value->addChild("$key",htmlspecialchars("$value"));
            }
        }

        return $xml_value;
    }
}