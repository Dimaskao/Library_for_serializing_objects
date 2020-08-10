<?php

require_once __DIR__ . '/SerializerInterface.php';
require_once __DIR__ . '/AbstractSerializer.php';

class XML extends AbstractSerializer implements SerializeInterface {
    final public function serialize($object,  $elemetn_list = []){

        //Getting all fields
        $public_value = $this->get_data($object, $elemetn_list);

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