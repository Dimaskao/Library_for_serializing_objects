<?php

require_once __DIR__ . '/SerializerInterface.php';
class XML implements SerializeInterface {
    final public function serialize($object,  $elemetn_list = []){

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

        $xml_value = new SimpleXMLElement('<elements/>');

        $xml_result =  $this->deep_serialize($public_value, $xml_value);

        //Returning result
        return $xml_result->asXML();
    }

    //This method processes an array of any depth
    private function deep_serialize($public_value, $xml_value){
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