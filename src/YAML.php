<?php

require_once __DIR__ . '/SerializerInterface.php';
require_once __DIR__ . '/AbstractSerializer.php';

class YAML extends AbstractSerializer implements SerializerInterface {
    final public function serialize($object, $elemetn_list = []) {

        //Getting all fields
        $public_value = $this->get_data($object, $elemetn_list);

        //Returning result
        return yaml_emit($public_value);
    }
}